<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderConfirmationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;

use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Route;

// Route::get('/test-mail/{id}', function ($id) {
//     try {
//         $order = \App\Models\Order::with('items.product')->find($id);

//         if (!$order) {
//             return 'Order not found.';
//         }

//         Mail::to('recipient@example.com')->send(new OrderConfirmation($order));
//         return 'Mail sent successfully!';
//     } catch (\Exception $e) {
//         return 'Error sending mail: ' . $e->getMessage();
//     }
// });


// Home Page Route
// Route::get('/', function () {
//     return view('home');
// })->name('home');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [SearchController::class, 'search'])->name('search');
// routes/web.php




Route::get('/about-us', [PageController::class, 'about'])->name('about.us');
Route::get('/privacy-policy', [PageController::class, 'privacy_policy'])->name('privacy_policy');
Route::get('/terms-&-condition', [PageController::class, 'terms_condition'])->name('terms_condition');
Route::get('/shipping-&-returns', [PageController::class, 'shipping_returns'])->name('shipping_returns');


Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::get('/faq', [FaqController::class, 'show'])->name('faqs');

Route::get('product/{productId}/reviews', [ReviewController::class, 'show'])->name('reviews.show');
Route::post('product/{productId}/reviews', [ReviewController::class, 'store'])->middleware('auth')->name('reviews.store');

// Checkout/Payment Routes

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
Route::post('/payment', [PaymentController::class, 'store'])->name('payment.store');
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');

// Order Routes
Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
Route::get('/order-confirmation/{orderId}', [OrderController::class, 'orderConfirmation'])->name('order.confirmation');


// Route::get('/invoice/{id}', [OrderConfirmationController::class, 'showInvoice'])->name('invoice.show');
// Route::post('/order/confirm', [OrderConfirmationController::class, 'confirm'])->name('order.confirm');

// Wishlist Routes
// Route::post('/wishlist/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
Route::post('/wishlist/toggle/{productId}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');

// Route::post('/wishlist/toggle/{productId}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/add', [WishlistController::class, 'store'])->name('wishlist.store');
Route::delete('/wishlist/remove/{productId}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

//Cart Routes
Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'store'])->name('cart.store');
Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::post('/cart/update-quantity/{id}', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');




// Shop Routes
Route::prefix('shop')->name('shop.')->group(function () {
    Route::get('/', [ShopController::class, 'index'])->name('index');
    Route::get('/product/{id}', [ShopController::class, 'show'])->name('show');
});
Route::get('/product/{id}', [ShopController::class, 'show'])->name('product.show');


// Admin Routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // Profile Routes
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Category Routes
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/', [CategoryController::class, 'store'])->name('store');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::patch('/{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
    });

    // Product Routes
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::put('/{product}', [ProductController::class, 'update'])->name('update');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
    });

    // Customer Routes
    Route::prefix('customers')->name('customers.')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('index');
        Route::get('/{user}', [CustomerController::class, 'show'])->name('show');
    });

   // Order Routes
Route::prefix('orders')->name('orders.')->group(function () {
    // Admin Order Index
    Route::get('/', [OrderController::class, 'adminindex'])->name('index');
    // Route::post('orders', [OrderController::class, 'store'])->name('orders.store');

    
    // Show specific order
    Route::get('/{order}', [OrderController::class, 'show'])->name('show');
    
    // Edit specific order
    Route::get('/{order}/edit', [OrderController::class, 'edit'])->name('edit');
    
    // Update specific order
    Route::put('/{order}', [OrderController::class, 'update'])->name('update');
    
    // Delete specific order
    Route::delete('/{order}', [OrderController::class, 'destroy'])->name('destroy');

     // New Delivery Management Routes
     Route::get('/{order}/deliver', [OrderController::class, 'deliver'])->name('deliver');
     Route::put('/{order}/deliver', [OrderController::class, 'updateDelivery'])->name('updateDelivery');
});

    // Order Edit Route (shows the form for editing the order)
    

   // Reviews Management
   Route::prefix('reviews')->name('reviews.')->group(function () {
    Route::get('/', [ReviewController::class, 'index'])->name('index');
    Route::get('details/{product}', [ReviewController::class, 'details'])->name('details');
});


    

    // FAQ Management
    Route::prefix('faqs')->name('faqs.')->group(function () {
        Route::get('/', [FaqController::class, 'index'])->name('index');
        // Other FAQ management routes can be added here
    });

// Contact Management Routes
Route::prefix('contacts')->name('contacts.')->group(function () {
    Route::get('/', [ContactController::class, 'contact_index'])->name('index'); // List all messages
    Route::get('/{id}', [ContactController::class, 'show'])->name('show'); // View a specific message
    Route::get('/{id}/reply', [ContactController::class, 'reply'])->name('reply'); // Reply to a specific message
    Route::post('/{id}/reply', [ContactController::class, 'sendReply'])->name('sendReply'); // Handle reply submission
});



    // Page Management Routes
    Route::prefix('pages')->name('pages.')->group(function () {
        Route::get('/', [PageController::class, 'index'])->name('index');
        Route::get('/create', [PageController::class, 'create'])->name('create');
        Route::post('/', [PageController::class, 'store'])->name('store');
        Route::get('/{page}/edit', [PageController::class, 'edit'])->name('edit');
        Route::patch('/{page}', [PageController::class, 'update'])->name('update');
        Route::delete('/{page}', [PageController::class, 'destroy'])->name('destroy');
    });

    

   
});

require __DIR__.'/auth.php';
