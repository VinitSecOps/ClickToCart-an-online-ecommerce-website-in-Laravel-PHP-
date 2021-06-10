<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {return view('pages.index');});

//auth & user
Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/password/change', 'HomeController@changePassword')->name('password.change');
Route::post('/password/update', 'HomeController@updatePassword')->name('password.update');
Route::post('/profile/update', 'HomeController@profileUpdate')->name('profile.update');
Route::get('profile', 'HomeController@Profile');
Route::get('/user/logout', 'HomeController@Logout')->name('user.logout');

//admin=======
Route::get('admin/home', 'AdminController@index');
Route::get('admin', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin', 'Admin\LoginController@login');

// Backend (Password Reset) 
Route::get('admin/password/reset/{user_type}', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin/password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin/reset/password/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
Route::post('admin/update/reset', 'Admin\ResetPasswordController@reset')->name('admin.reset.update');
Route::get('/admin/Change/Password','AdminController@ChangePassword')->name('admin.password.change');
Route::post('/admin/password/update','AdminController@Update_pass')->name('admin.password.update'); 
Route::get('/admin/edit/profile','AdminController@EditProfile')->name('admin.edit.profile'); 
Route::post('/admin/update/profile','AdminController@UpdateProfile')->name('admin.update.profile'); 
Route::get('admin/logout', 'AdminController@logout')->name('admin.logout');

//Backend (categories) 
Route::get('admin/categories','Admin\Category\CategoryController@Category')->name('categories');
Route::post('admin/store/category','Admin\Category\CategoryController@StoreCategory')->name('store.category');
Route::get('delete/category/{id}','Admin\Category\CategoryController@DeleteCategory');
Route::get('edit/category/{id}','Admin\Category\CategoryController@EditCategory');
Route::post('update/category/{id}','Admin\Category\CategoryController@UpdateCategory');

//Backend (Brands)
Route::get('admin/brands','Admin\Category\BrandController@Brand')->name('brands');
Route::post('admin/store/brand','Admin\Category\BrandController@StoreBrand')->name('store.brand');
Route::get('delete/brand/{id}','Admin\Category\BrandController@DeleteBrand');
Route::get('edit/brand/{id}','Admin\Category\BrandController@EditBrand');
Route::post('update/brand/{id}','Admin\Category\BrandController@UpdateBrand');

//Backend (Sub Categories)
Route::get('admin/sub/categories','Admin\Category\SubCategoryController@SubCategory')->name('sub.categories');
Route::post('admin/store/sub/category','Admin\Category\SubCategoryController@StoreSubCategory')->name('store.sub.category');
Route::get('delete/sub/category/{id}','Admin\Category\SubCategoryController@DeleteSubCategory');
Route::get('edit/sub/category/{id}','Admin\Category\SubCategoryController@EditSubCategory');
Route::post('update/sub/category/{id}','Admin\Category\SubCategoryController@SubUpdateCategory');

//Backend (Coupons) 
Route::get('admin/coupons','Admin\Category\CouponController@Coupon')->name('admin.coupon');
Route::post('admin/store/coupon','Admin\Category\CouponController@StoreCoupon')->name('store.coupon');
Route::get('delete/coupon/{id}','Admin\Category\CouponController@DeleteCoupon');
Route::get('edit/coupon/{id}','Admin\Category\CouponController@EditCoupon');
Route::post('update/coupon/{id}','Admin\Category\CouponController@UpdateCoupon');

//Backend (Newsletter)
Route::get('admin/newsletters','Admin\Category\NewsletterController@Newsletter')->name('admin.newsletter');
Route::get('delete/newsletter/{id}','Admin\Category\NewsletterController@DeleteNewsletter');
Route::get('delete/selected/newsletter','Admin\Category\NewsletterController@DeleteSelectedNewsletter');

//Backend (Product)
Route::get('admin/products/all','Admin\ProductController@index')->name('all.product');
Route::get('admin/products/add','Admin\ProductController@Create')->name('add.product');
Route::post('admin/store/product','Admin\ProductController@StoreProduct')->name('store.product');
Route::get('delete/product/{id}','Admin\ProductController@DeleteProduct');
Route::get('view/product/{id}','Admin\ProductController@ViewProduct');
Route::get('edit/product/{id}','Admin\ProductController@EditProduct');
Route::post('update/product/withoutphoto/{id}','Admin\ProductController@UpdateProductWithoutPhoto');
Route::post('update/product/withphoto/{id}','Admin\ProductController@UpdateProductWithPhoto');
Route::get('inactive/product/{id}','Admin\ProductController@Inactive');
Route::get('active/product/{id}','Admin\ProductController@Active');


//Backend (Blog)
Route::get('admin/blog/category/list','Admin\PostController@BlogCategoryList')->name('add.blog.categorylist');
Route::post('admin/blog/store/category','Admin\PostController@StoreBlogCategory')->name('store.blog.category');
Route::get('delete/blog/category/{id}','Admin\PostController@DeleteBlogCategory');
Route::get('edit/blog/category/{id}','Admin\PostController@EditBlogCategory');
Route::post('update/blog/category/{id}','Admin\PostController@UpdateBlogCategory');
Route::get('add/blog/post','Admin\PostController@Create')->name('add.blog.post');
Route::get('all/blog/post','Admin\PostController@Index')->name('all.blog.post');
Route::post('admin/store/post','Admin\PostController@StorePost')->name('store.post');
Route::get('delete/blog/post/{id}','Admin\PostController@DeleteBlogPost');
Route::get('edit/blog/post/{id}','Admin\PostController@EditPost');
Route::post('update/blog/post/{id}','Admin\PostController@UpdateBlogPost');



//Backend (Order)
Route::get('admin/pending/order','Admin\OrderController@NewOrder')->name('admin.neworder');
Route::get('admin/accept/payment','Admin\OrderController@AcceptPayment')->name('admin.accept.payment');
Route::get('admin/cancel/order','Admin\OrderController@CancelOrder')->name('admin.cancel.order');
Route::get('admin/process/payment','Admin\OrderController@ProcessPayment')->name('admin.process.payment');
Route::get('admin/success/payment','Admin\OrderController@SuccessPayment')->name('admin.success.payment');
Route::get('admin/view/order/{id}','Admin\OrderController@ViewOrder');
Route::get('admin/payment/accept/{id}','Admin\OrderController@PaymentAccept');
Route::get('admin/order/cancel/{id}','Admin\OrderController@OrderCancel');
Route::get('admin/delivery/proccess/{id}','Admin\OrderController@DeliveryProccess');
Route::get('admin/delivery/done/{id}','Admin\OrderController@DeliveryDone');


//Backend (Subcategory show in Add product page)
Route::get('get/subcategory/{id}','Admin\ProductController@GetSubCategory');

//Backend (Seo)
Route::get('admin/seo','Admin\SeoController@index')->name('admin.seo');
Route::post('admin/update/seo','Admin\SeoController@Update')->name('update.seo');

//Backend (Report)
Route::get('admin/today/order','Admin\ReportController@TodayOrder')->name('today.order');
Route::get('admin/today/delivery','Admin\ReportController@TodayDelivery')->name('today.delivery');
Route::get('admin/this/month','Admin\ReportController@ThisMonth')->name('this.month');
Route::get('admin/search/report','Admin\ReportController@Search')->name('search.report');
Route::post('admin/search/by/year','Admin\ReportController@SearchByYear')->name('search.by.year');
Route::post('admin/search/by/month','Admin\ReportController@SearchByMonth')->name('search.by.month');
Route::post('admin/search/by/date','Admin\ReportController@SearchByDate')->name('search.by.date');


//Backend (User Role)
Route::get('admin/all/user','Admin\UserRoleController@AllUser')->name('admin.all.user');
Route::get('admin/add/admin','Admin\UserRoleController@AddUser')->name('add.admin');
Route::post('admin/store/admin','Admin\UserRoleController@StoreUser')->name('store.admin');
Route::get('delete/admin/{id}','Admin\UserRoleController@DeleteUser');
Route::get('edit/admin/{id}','Admin\UserRoleController@EditUser');
Route::post('admin/update/admin','Admin\UserRoleController@UpdateUser')->name('update.admin');

//Backend (Site Setting)
Route::get('admin/site/setting','Admin\SiteSettingController@index')->name('admin.site.setting');
Route::get('admin/site/tc/setting','Admin\SiteSettingController@tc')->name('admin.site.tc.setting');
Route::post('admin/update/sitesetting','Admin\SiteSettingController@UpdateSiteSetting')->name('update.siteseting');
Route::post('admin/update/sitesetting/logo','Admin\SiteSettingController@SettingLogo')->name('update.logo.siteseting');
Route::post('admin/update/sitetcsetting','Admin\SiteSettingController@UpdateTCSiteSetting')->name('update.sitetcseting');

//Backend (Return Order)
Route::get('admin/return/request','Admin\ReturnController@ReturnRequest')->name('admin.return.request');
Route::get('admin/return/all','Admin\ReturnController@AllRequest')->name('admin.all.return');
Route::get('admin/approve/return/{id}','Admin\ReturnController@RequestApprove');


//Backend (Contact)
Route::get('admin/all/messages','Admin\ContactController@AllMessages')->name('all.messages');
Route::get('admin/view/message/{id}','Admin\ContactController@ViewMessages');
Route::get('admin/view/replied/message/{id}','Admin\ContactController@ViewRepliedMessages');
Route::post('admin/reply/message/','Admin\ContactController@ReplyMessages');



//Frontend (Newsletter)
Route::post('store/newsletter/','FrontendController@StoreNewsletter')->name('store.newsletter');
Route::get('unsubscribe/newsletter/{email}','FrontendController@Unsubscribe')->name('unsubscribe');
Route::get('disclaimer','FrontendController@Disclaimer')->name('disclaimer');
Route::get('policy','FrontendController@Policy')->name('policy');
Route::get('safe','FrontendController@Safe')->name('safe');
Route::get('terms','FrontendController@Terms')->name('terms');
Route::get('about/us','FrontendController@About');


//Frontend (Order Tracking)
Route::get('/user/order/view/{id}','OrderController@ViewOrderDetails');
Route::get('order/tracking/{status_code}', 'OrderController@OrderTracking');
Route::get('invoice/{id}', 'OrderController@Invoice');
Route::get('success/orderlist/', 'OrderController@SuccessOrderList')->name('success.orderlist');
Route::get('request/return/{id}', 'OrderController@ReturnOrder');


//Frontend (Blog Post)
Route::get('blog/post/','BlogController@Blog')->name('blog.post');
Route::get('language/english/','BlogController@English')->name('language.english');
Route::get('language/hindi/','BlogController@Hindi')->name('language.hindi');
Route::get('language/gujarati/','BlogController@Gujarati')->name('language.gujarati');
Route::get('blog/single/{id}','BlogController@BlogSingle');


//Frontend (Wishlist)
Route::get('add/wishlist/{id}','WishlistController@addWishlist');
Route::get('/user/wishlist/','WishlistController@Wishlist')->name('user.wishlist');
Route::get('/remove/wishlist/{id}','WishlistController@RemoveWishlist');
Route::get('/remove/all/wishlist','WishlistController@RemoveAllWishlist');

//Frontend (Add To Cart)
Route::get('add/to/cart/{id}','Cartcontroller@addToCart');
Route::get('check','Cartcontroller@check');
Route::get('product/cart','Cartcontroller@ShowCart')->name('show.cart');
Route::get('destroy/cart','Cartcontroller@DestroyCart')->name('cart.destroy');
Route::get('remove/cart/{rowId}','Cartcontroller@RemoveCart');
Route::post('update/cart/item/','Cartcontroller@UpdateCart')->name('update.cart');
Route::get('/cart/product/view/{id}','Cartcontroller@ViewProduct');
Route::post('/insert/into/cart/','Cartcontroller@InsertIntoCart')->name('insert.into.cart');
Route::get('/user/checkout/','Cartcontroller@Checkout')->name('user.checkout');
Route::post('/apply/coupon/','Cartcontroller@ApplyCoupon')->name('apply.coupon');
Route::get('/remove/coupon/','Cartcontroller@RemoveCoupon')->name('remove.coupon');

//Frontend (Product Details)
Route::get('product/details/{id}','ProductController@ProductView');
Route::post('cart/product/add/{id}','ProductController@AddCart');
Route::get('product/{id}/{sort}','ProductController@ProductsView');
Route::get('allcategory/{id}/{sort}','ProductController@CategoryView');

//Frontend (Payament Steps)
Route::get('/payment/step/','PaymentController@PaymentPage')->name('payment.step');
Route::post('user/payment/process/','PaymentController@PaymentProcess')->name('payemnt.process');
Route::post('user/stripe/charge/','PaymentController@StripeCharge')->name('stripe.charge');

//Frontend (Dropdown)
Route::get('dependent-dropdown', 'DropdownController@index');
Route::post('api/fetch-states', 'DropdownController@fetchState');
Route::post('api/fetch-cities', 'DropdownController@fetchCity');

//Frontend (Contact)
Route::get('/contact/page/','ContactController@ContactPage')->name('contact.page');
Route::post('/contact/form/','ContactController@ContactForm')->name('contact.form');

//Frontend (Product Search)
Route::get('/product/search/','FrontendController@ProductSearch')->name('product.search');
Route::get('/search-product','FrontendController@SearchData');

//Frontend (login Google)
Route::get('/auth/redirect/{provider}', 'GoogleLoginController@redirect');
Route::get('/callback/{provider}', 'GoogleLoginController@callback');

//Frontend (login Facebook)
Route::get('/auth/redirect/{provider}', 'FacebookLoginController@redirect');
Route::get('/callback/{provider}', 'FacebookLoginController@callback');