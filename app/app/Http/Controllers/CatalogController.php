<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * CatalogController — Catálogo Público (DEV-FRONT: Genesis-Valencia)
 *
 * Controlador público para la Landing Page, listado de catálogo y detalle de producto.
 * Utiliza datos mock temporales hasta que DEV-PROD implemente Product/Category models.
 *
 * TODO: Reemplazar getCategories() con Category::all()
 * TODO: Reemplazar getProducts() con Product::where('status','active')->with('category')
 */
class CatalogController extends Controller
{
    /**
     * Datos mock de categorías.
     * Estructura idéntica a lo que devolvería Category::all()
     */
    private function getCategories(): Collection
    {
        return collect([
            (object) ['id' => 1, 'name' => 'Dulces',     'slug' => 'dulces',     'description' => 'Snacks dulces y postres artesanales'],
            (object) ['id' => 2, 'name' => 'Salados',    'slug' => 'salados',    'description' => 'Snacks salados y crujientes'],
            (object) ['id' => 3, 'name' => 'Bebidas',    'slug' => 'bebidas',    'description' => 'Bebidas frías y calientes'],
            (object) ['id' => 4, 'name' => 'Saludables', 'slug' => 'saludables', 'description' => 'Opciones saludables y naturales'],
        ]);
    }

    /**
     * Datos mock de productos.
     * Estructura idéntica a lo que devolvería Product::with('category')->get()
     */
    private function getProducts(): Collection
    {
        $cats = $this->getCategories();

        return collect([
            (object) [
                'id' => 1, 'name' => 'Muffin de Chocolate', 'slug' => 'muffin-de-chocolate',
                'description' => 'Delicioso muffin de chocolate belga con chips extra. Horneado diariamente con ingredientes premium.',
                'price' => 3.50, 'image_path' => null, 'status' => 'active',
                'category' => $cats->firstWhere('id', 1),
            ],
            (object) [
                'id' => 2, 'name' => 'Galletas de Avena', 'slug' => 'galletas-de-avena',
                'description' => 'Crujientes galletas de avena con pasas y un toque de canela. Perfectas para acompañar tu café.',
                'price' => 2.75, 'image_path' => null, 'status' => 'active',
                'category' => $cats->firstWhere('id', 1),
            ],
            (object) [
                'id' => 3, 'name' => 'Brownie Artesanal', 'slug' => 'brownie-artesanal',
                'description' => 'Brownie denso y húmedo con nueces caramelizadas. Una experiencia de sabor intenso.',
                'price' => 4.00, 'image_path' => null, 'status' => 'active',
                'category' => $cats->firstWhere('id', 1),
            ],
            (object) [
                'id' => 4, 'name' => 'Dona Glaseada', 'slug' => 'dona-glaseada',
                'description' => 'Dona esponjosa con glaseado de vainilla y chispas de colores. Un clásico irresistible.',
                'price' => 2.50, 'image_path' => null, 'status' => 'active',
                'category' => $cats->firstWhere('id', 1),
            ],
            (object) [
                'id' => 5, 'name' => 'Chips de Plátano', 'slug' => 'chips-de-platano',
                'description' => 'Chips crujientes de plátano verde con sal marina. Snack ligero y adictivo.',
                'price' => 2.00, 'image_path' => null, 'status' => 'active',
                'category' => $cats->firstWhere('id', 2),
            ],
            (object) [
                'id' => 6, 'name' => 'Empanada de Queso', 'slug' => 'empanada-de-queso',
                'description' => 'Empanada horneada rellena de queso mozzarella fundido. Crujiente por fuera, suave por dentro.',
                'price' => 3.00, 'image_path' => null, 'status' => 'active',
                'category' => $cats->firstWhere('id', 2),
            ],
            (object) [
                'id' => 7, 'name' => 'Nachos con Guacamole', 'slug' => 'nachos-con-guacamole',
                'description' => 'Nachos de maíz crujientes acompañados de guacamole fresco casero y pico de gallo.',
                'price' => 5.50, 'image_path' => null, 'status' => 'active',
                'category' => $cats->firstWhere('id', 2),
            ],
            (object) [
                'id' => 8, 'name' => 'Palomitas Gourmet', 'slug' => 'palomitas-gourmet',
                'description' => 'Palomitas artesanales con mantequilla de trufa y sal del Himalaya.',
                'price' => 3.25, 'image_path' => null, 'status' => 'active',
                'category' => $cats->firstWhere('id', 2),
            ],
            (object) [
                'id' => 9, 'name' => 'Smoothie de Fresa', 'slug' => 'smoothie-de-fresa',
                'description' => 'Smoothie cremoso de fresas frescas con yogurt natural y un toque de miel.',
                'price' => 4.50, 'image_path' => null, 'status' => 'active',
                'category' => $cats->firstWhere('id', 3),
            ],
            (object) [
                'id' => 10, 'name' => 'Café Latte', 'slug' => 'cafe-latte',
                'description' => 'Café espresso con leche vaporizada y arte latte. Preparado con granos de origen.',
                'price' => 3.75, 'image_path' => null, 'status' => 'active',
                'category' => $cats->firstWhere('id', 3),
            ],
            (object) [
                'id' => 11, 'name' => 'Limonada Natural', 'slug' => 'limonada-natural',
                'description' => 'Limonada refrescante con hierbabuena fresca y el punto justo de dulzor.',
                'price' => 2.50, 'image_path' => null, 'status' => 'active',
                'category' => $cats->firstWhere('id', 3),
            ],
            (object) [
                'id' => 12, 'name' => 'Té Helado de Durazno', 'slug' => 'te-helado-de-durazno',
                'description' => 'Té negro helado infusionado con duraznos maduros. Refrescante y aromático.',
                'price' => 3.00, 'image_path' => null, 'status' => 'active',
                'category' => $cats->firstWhere('id', 3),
            ],
            (object) [
                'id' => 13, 'name' => 'Bowl de Açaí', 'slug' => 'bowl-de-acai',
                'description' => 'Bowl de açaí con granola casera, banana fresca, frutos rojos y miel de abeja.',
                'price' => 6.50, 'image_path' => null, 'status' => 'active',
                'category' => $cats->firstWhere('id', 4),
            ],
            (object) [
                'id' => 14, 'name' => 'Mix de Frutos Secos', 'slug' => 'mix-de-frutos-secos',
                'description' => 'Mezcla premium de almendras, nueces, arándanos deshidratados y semillas de calabaza.',
                'price' => 4.25, 'image_path' => null, 'status' => 'active',
                'category' => $cats->firstWhere('id', 4),
            ],
            (object) [
                'id' => 15, 'name' => 'Barrita Energética', 'slug' => 'barrita-energetica',
                'description' => 'Barrita de avena y miel con chispas de chocolate oscuro. Energía natural para tu día.',
                'price' => 2.75, 'image_path' => null, 'status' => 'active',
                'category' => $cats->firstWhere('id', 4),
            ],
            (object) [
                'id' => 16, 'name' => 'Yogurt con Granola', 'slug' => 'yogurt-con-granola',
                'description' => 'Yogurt griego natural con granola artesanal y frutas de temporada.',
                'price' => 3.50, 'image_path' => null, 'status' => 'inactive',
                'category' => $cats->firstWhere('id', 4),
            ],
        ]);
    }

    /**
     * Landing Page pública (GET /)
     */
    public function landing()
    {
        $categories = $this->getCategories();
        $featuredProducts = $this->getProducts()->where('status', 'active')->take(8);

        return view('landing', compact('categories', 'featuredProducts'));
    }

    /**
     * Catálogo con búsqueda y filtros (GET /catalogo)
     * TODO: Reemplazar con queries Eloquent: Product::where('status','active')
     *       ->whereHas('category', ...)->where('name','like',...)->paginate(12)
     */
    public function index(Request $request)
    {
        $categories = $this->getCategories();
        $products = $this->getProducts();

        // Mostrar todos (activos se ven normales, inactivos con estilo "Agotado")
        $filtered = $products;

        // Filtro por categoría
        if ($request->filled('category')) {
            $slug = $request->input('category');
            $filtered = $filtered->filter(fn($p) => $p->category->slug === $slug);
        }

        // Filtro por búsqueda
        if ($request->filled('search')) {
            $search = mb_strtolower($request->input('search'));
            $filtered = $filtered->filter(
                fn($p) => str_contains(mb_strtolower($p->name), $search)
                    || str_contains(mb_strtolower($p->description), $search)
            );
        }

        // Paginación manual sobre colección mock
        $page = max(1, (int) $request->input('page', 1));
        $perPage = 12;
        $paginated = new LengthAwarePaginator(
            $filtered->forPage($page, $perPage)->values(),
            $filtered->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('catalog.index', [
            'products'        => $paginated,
            'categories'      => $categories,
            'currentCategory' => $request->input('category'),
            'searchTerm'      => $request->input('search'),
        ]);
    }

    /**
     * Detalle de producto (GET /catalogo/{slug})
     * TODO: Reemplazar con Product::where('slug', $slug)->with('category')->firstOrFail()
     */
    public function show(string $slug)
    {
        $product = $this->getProducts()->firstWhere('slug', $slug);

        if (! $product) {
            abort(404);
        }

        $relatedProducts = $this->getProducts()
            ->where('status', 'active')
            ->where('id', '!=', $product->id)
            ->filter(fn($p) => $p->category->id === $product->category->id)
            ->take(4);

        return view('catalog.show', compact('product', 'relatedProducts'));
    }
}
