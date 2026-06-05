<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WhatsAppController extends Controller
{
    /**
     * Mock products array. Ready to be replaced by Product::all() in future integration.
     */
    private array $mockProducts = [
        1 => [
            'id' => 1, 
            'name' => 'Muffin de Chocolate', 
            'price' => 3.00, 
            'description' => 'Esponjoso muffin con chispas de chocolate semi-amargo.', 
            'image' => 'https://images.unsplash.com/photo-1607958996333-41aef7caefaa?w=500&auto=format&fit=crop&q=60'
        ],
        2 => [
            'id' => 2, 
            'name' => 'Té Verde Orgánico', 
            'price' => 2.00, 
            'description' => 'Refrescante té verde natural con hojas seleccionadas.', 
            'image' => 'https://images.unsplash.com/photo-1576092768241-dec231879fc3?w=500&auto=format&fit=crop&q=60'
        ],
        3 => [
            'id' => 3, 
            'name' => 'Snack de Papas Nativas', 
            'price' => 1.50, 
            'description' => 'Crujientes papas fritas artesanales con sal marina.', 
            'image' => 'https://images.unsplash.com/photo-1566478989037-eec170784d0b?w=500&auto=format&fit=crop&q=60'
        ],
        4 => [
            'id' => 4, 
            'name' => 'Galleta de Avena y Miel', 
            'price' => 1.80, 
            'description' => 'Galleta horneada con avena integral y miel de abeja pura.', 
            'image' => 'https://images.unsplash.com/photo-1590080875515-8a3a8dc5735e?w=500&auto=format&fit=crop&q=60'
        ],
        5 => [
            'id' => 5, 
            'name' => 'Café Americano', 
            'price' => 2.50, 
            'description' => 'Café expreso diluido en agua caliente, granos de altura.', 
            'image' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=500&auto=format&fit=crop&q=60'
        ]
    ];

    /**
     * Show the temporary cart page with items and mock products catalog.
     */
    public function showCart()
    {
        $cart = Session::get('cart', []);
        
        // Calculate subtotal, taxes, and total
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        
        $total = $subtotal;

        return view('cart', [
            'cart' => $cart,
            'products' => $this->mockProducts,
            'total' => $total,
            'whatsappPhone' => env('WHATSAPP_PHONE', '59398920065')
        ]);
    }

    /**
     * Add a product to the session cart.
     */
    public function addToCart(Request $request, $id)
    {
        $id = (int)$id;
        if (!array_key_exists($id, $this->mockProducts)) {
            return redirect()->route('cart.show')->with('error', 'Producto no encontrado.');
        }

        $product = $this->mockProducts[$id];
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'image' => $product['image'],
                'quantity' => 1
            ];
        }

        Session::put('cart', $cart);

        return redirect()->route('cart.show')->with('success', "{$product['name']} agregado al carrito.");
    }

    /**
     * Remove or decrease a product from the session cart.
     */
    public function removeFromCart(Request $request, $id)
    {
        $id = (int)$id;
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
                $message = "Cantidad de {$cart[$id]['name']} reducida.";
            } else {
                $message = "{$cart[$id]['name']} eliminado del carrito.";
                unset($cart[$id]);
            }
            Session::put('cart', $cart);
        } else {
            return redirect()->route('cart.show')->with('error', 'El producto no está en el carrito.');
        }

        return redirect()->route('cart.show')->with('success', $message);
    }

    /**
     * Clear all products from the session cart.
     */
    public function clearCart()
    {
        Session::forget('cart');
        return redirect()->route('cart.show')->with('success', 'Carrito vaciado exitosamente.');
    }

    /**
     * Format cart contents and redirect to WhatsApp API.
     */
    public function checkoutWhatsApp(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:100',
            'delivery_type' => 'required|in:llevar,local'
        ], [
            'customer_name.required' => 'El nombre es obligatorio para procesar el pedido.',
            'delivery_type.required' => 'Debe seleccionar el tipo de entrega.'
        ]);

        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.show')->with('error', 'El carrito está vacío. Agregue algunos snacks antes de comprar.');
        }

        // Calculate total
        $total = 0;
        $itemsText = "";
        foreach ($cart as $item) {
            $itemTotal = $item['price'] * $item['quantity'];
            $total += $itemTotal;
            $itemsText .= "- {$item['quantity']}x {$item['name']} ($" . number_format($item['price'], 2) . " c/u)\n";
        }

        // Format delivery label
        $deliveryLabel = $request->delivery_type === 'llevar' ? 'Para Llevar / Delivery' : 'Consumo Local';

        // WhatsApp message construction using Markdown
        $message = "*¡Hola! Me gustaría hacer el siguiente pedido en SnackConnect:*\n";
        $message .= "---------------------------------\n";
        $message .= $itemsText;
        $message .= "---------------------------------\n";
        $message .= "*Total:* $" . number_format($total, 2) . "\n";
        $message .= "*Cliente:* " . trim($request->customer_name) . "\n";
        $message .= "*Entrega:* " . $deliveryLabel . "\n";

        // Get WhatsApp Phone Number
        $phone = env('WHATSAPP_PHONE', '59398920065');
        
        // Clean phone number: remove spaces, dashes, plus sign, etc.
        $cleanPhone = preg_replace('/[^0-9]/', '', $phone);

        // Clear cart session immediately as per RN-03/spec/modulos/whatsapp.md
        Session::forget('cart');

        // Generate redirect link
        $whatsappUrl = "https://api.whatsapp.com/send?phone=" . $cleanPhone . "&text=" . urlencode($message);

        return redirect()->away($whatsappUrl);
    }
}
