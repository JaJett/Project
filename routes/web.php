    <?php

    use App\Http\Controllers\ProfileController;
    use Illuminate\Support\Facades\Route;
    use Illuminate\Routing\Controllers\Middleware;
    use App\Http\Controllers\Admin\UserController;
    use App\Http\Controllers\Admin\MenuController;
    use App\Http\Controllers\Admin\DashboardController;
    use App\Http\Controllers\User\DashboardController as UserDashboard;
    use App\Http\Controllers\User\OrderController as UserOrder;
    use App\Http\Controllers\User\MenuController as UserMenu;
    use App\Http\Controllers\User\OrderItemController;


    Route::middleware(['auth', 'role:admin'])->get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('admin/reports/sales', [DashboardController::class, 'salesReport'])->name('admin.reports.sales');

    Route::get('admin/reports/sales/print', [DashboardController::class, 'salesReportPrint'])->name('admin.reports.sales.print');

    Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
        Route::resource('menus', MenuController::class);
        Route::get('/statistics', [DashboardController::class, 'statistics'])->name('statistics');
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    });

    Route::get('order-items/{orderItem}/print', [\App\Http\Controllers\User\OrderItemController::class, 'print'])->name('user.order-items.print');

    Route::get('/orders/{order}/print', [UserOrder::class, 'print'])->name('user.orders.print');

    Route::patch('/user/orders/{order}/status', [UserOrder::class, 'updateStatus'])->name('user.orders.updateStatus');

    Route::prefix('user')->name('user.')->middleware(['auth'])->group(function () {
        Route::resource('menus', \App\Http\Controllers\User\MenuController::class);
    });

    Route::resource('order-items', \App\Http\Controllers\User\OrderItemController::class)
    ->only(['index', 'show', 'create', 'store']) // Tambahkan create dan store
    ->names('user.order-items')
    ->middleware('auth');

    Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
        Route::get('/', [UserDashboard::class, 'index'])->name('dashboard');
        Route::resource('orders', UserOrder::class);
        Route::resource('menus', UserMenu::class); // pastikan ini adalah User\MenuController
    });



    Route::get('/', function () {
        if (auth()->check()) {
            return auth()->user()->role === 'admin'
                ? redirect()->route('admin.dashboard')
                : redirect()->route('user.dashboard');
        }
        return redirect()->route('login');
    });


    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__.'/auth.php';
