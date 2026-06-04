<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class WhatsAppCheckoutTest extends TestCase
{
    /**
     * Test the cart page loads and displays products.
     */
    public function test_cart_page_loads_successfully()
    {
        $response = $this->get(route('cart.show'));

        $response->assertStatus(200);
        $response->assertViewHas('products');
        $response->assertSee('Muffin de Chocolate');
    }

    /**
     * Test adding an item to the session cart.
     */
    public function test_add_item_to_cart()
    {
        // Add product with ID 1
        $response = $this->post(route('cart.add', 1));

        $response->assertRedirect(route('cart.show'));
        $response->assertSessionHas('cart');
        
        $cart = Session::get('cart');
        $this->assertArrayHasKey(1, $cart);
        $this->assertEquals(1, $cart[1]['quantity']);
    }

    /**
     * Test decreasing item quantity in the session cart.
     */
    public function test_remove_or_decrease_item_in_cart()
    {
        // Setup cart session with quantity of 2
        $cart = [
            1 => [
                'id' => 1,
                'name' => 'Muffin de Chocolate',
                'price' => 3.00,
                'image' => 'muffin.jpg',
                'quantity' => 2
            ]
        ];
        Session::put('cart', $cart);

        // Decrease quantity (from 2 to 1)
        $response = $this->post(route('cart.remove', 1));

        $response->assertRedirect(route('cart.show'));
        $updatedCart = Session::get('cart');
        $this->assertEquals(1, $updatedCart[1]['quantity']);

        // Remove item completely (from 1 to 0)
        $response = $this->post(route('cart.remove', 1));
        $finalCart = Session::get('cart');
        $this->assertArrayNotHasKey(1, $finalCart);
    }

    /**
     * Test clearing the entire session cart.
     */
    public function test_clear_cart()
    {
        $cart = [
            1 => ['id' => 1, 'name' => 'Muffin de Chocolate', 'price' => 3.00, 'image' => 'muff.jpg', 'quantity' => 1],
            2 => ['id' => 2, 'name' => 'Té Verde Orgánico', 'price' => 2.00, 'image' => 'tea.jpg', 'quantity' => 3]
        ];
        Session::put('cart', $cart);

        $response = $this->post(route('cart.clear'));

        $response->assertRedirect(route('cart.show'));
        $this->assertNull(Session::get('cart'));
    }

    /**
     * Test validation failure during WhatsApp checkout.
     */
    public function test_checkout_validation_requires_name_and_delivery_type()
    {
        $cart = [
            1 => ['id' => 1, 'name' => 'Muffin de Chocolate', 'price' => 3.00, 'image' => 'muff.jpg', 'quantity' => 1]
        ];
        Session::put('cart', $cart);

        $response = $this->post(route('checkout.whatsapp'), [
            'customer_name' => '',
            'delivery_type' => ''
        ]);

        $response->assertSessionHasErrors(['customer_name', 'delivery_type']);
    }

    /**
     * Test WhatsApp redirection URL is built correctly and session cart is cleared.
     */
    public function test_successful_whatsapp_checkout_redirection_and_session_clear()
    {
        // Add items to session cart
        $cart = [
            1 => ['id' => 1, 'name' => 'Muffin de Chocolate', 'price' => 3.00, 'image' => 'muff.jpg', 'quantity' => 2],
            2 => ['id' => 2, 'name' => 'Té Verde Orgánico', 'price' => 2.00, 'image' => 'tea.jpg', 'quantity' => 1]
        ];
        Session::put('cart', $cart);

        // Run post request with valid data
        $response = $this->post(route('checkout.whatsapp'), [
            'customer_name' => 'Jhostyn Baños',
            'delivery_type' => 'llevar'
        ]);

        // Assert redirect to api.whatsapp.com
        $response->assertStatus(302);
        
        $redirectUrl = $response->headers->get('Location');
        $this->assertStringContainsString('https://api.whatsapp.com/send', $redirectUrl);
        $this->assertStringContainsString('phone=59398920065', $redirectUrl);
        
        // Assert session cart is cleared
        $this->assertNull(Session::get('cart'));
    }
}
