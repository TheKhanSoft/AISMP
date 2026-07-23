<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

// Auth Components
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Auth\EmailVerification;

// Admin Components
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Settings\ManageSettings as AdminSettings;
use App\Livewire\Admin\Users\UserList as AdminUserList;
use App\Livewire\Admin\Users\UserForm as AdminUserForm;
use App\Livewire\Admin\ActivityLog\ActivityLogList as AdminActivityLog;

// Admin - Content Management
use App\Livewire\Admin\Pages\PageList as AdminPageList;
use App\Livewire\Admin\Pages\PageForm as AdminPageForm;
use App\Livewire\Admin\Homepage\HeroSlideList as AdminHeroSlideList;
use App\Livewire\Admin\Homepage\HeroSlideForm as AdminHeroSlideForm;
use App\Livewire\Admin\Homepage\StatisticList as AdminStatisticList;
use App\Livewire\Admin\Homepage\StatisticForm as AdminStatisticForm;
use App\Livewire\Admin\Homepage\TestimonialList as AdminTestimonialList;
use App\Livewire\Admin\Homepage\TestimonialForm as AdminTestimonialForm;
use App\Livewire\Admin\Homepage\CallToActionList as AdminCtaList;
use App\Livewire\Admin\Homepage\CallToActionForm as AdminCtaForm;
use App\Livewire\Admin\Homepage\FeaturedSectionList as AdminFeaturedSectionList;
use App\Livewire\Admin\Homepage\FeaturedSectionForm as AdminFeaturedSectionForm;

// Admin - News & Blog
use App\Livewire\Admin\News\NewsList as AdminNewsList;
use App\Livewire\Admin\News\NewsForm as AdminNewsForm;
use App\Livewire\Admin\Blog\PostList as AdminPostList;
use App\Livewire\Admin\Blog\PostForm as AdminPostForm;
use App\Livewire\Admin\Categories\CategoryList as AdminCategoryList;
use App\Livewire\Admin\Categories\CategoryForm as AdminCategoryForm;
use App\Livewire\Admin\Tags\TagList as AdminTagList;
use App\Livewire\Admin\Tags\TagForm as AdminTagForm;
use App\Livewire\Admin\Comments\CommentList as AdminCommentList;

// Admin - Gallery, Downloads, Partners, Council
use App\Livewire\Admin\Gallery\GalleryList as AdminGalleryList;
use App\Livewire\Admin\Gallery\GalleryForm as AdminGalleryForm;
use App\Livewire\Admin\Downloads\DownloadList as AdminDownloadList;
use App\Livewire\Admin\Downloads\DownloadForm as AdminDownloadForm;
use App\Livewire\Admin\Partners\PartnerList as AdminPartnerList;
use App\Livewire\Admin\Partners\PartnerForm as AdminPartnerForm;
use App\Livewire\Admin\Council\CouncilMemberList as AdminCouncilList;
use App\Livewire\Admin\Council\CouncilMemberForm as AdminCouncilForm;

// Admin - Communication
use App\Livewire\Admin\Contact\ContactMessageList as AdminContactList;
use App\Livewire\Admin\Newsletter\SubscriberList as AdminSubscriberList;
use App\Livewire\Admin\Faq\FaqList as AdminFaqList;
use App\Livewire\Admin\Faq\FaqForm as AdminFaqForm;

// Admin - Menus
use App\Livewire\Admin\Menus\MenuManager as AdminMenuManager;

// Member Components
use App\Livewire\Member\Dashboard as MemberDashboard;
use App\Livewire\Member\ProfileManager;
use App\Livewire\Member\Membership\Apply as MembershipApply;
use App\Livewire\Member\Membership\Status as MembershipStatus;
use App\Livewire\Member\Events\EventCatalog;
use App\Livewire\Member\Events\EventDetails;
use App\Livewire\Member\Events\MyEvents;

/*
|--------------------------------------------------------------------------
| Rate Limiting
|--------------------------------------------------------------------------
*/
RateLimiter::for('login', function (Request $request) {
    return Limit::perMinute(5)->by($request->ip());
});

/*
|--------------------------------------------------------------------------
| Public Routes (Placeholders until Phase 7)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['guest'])->group(function () {
    Route::get('/login', Login::class)->name('login')->middleware('throttle:login');
    Route::get('/register', Register::class)->name('register');
    Route::get('/forgot-password', ForgotPassword::class)->name('password.request');
    Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');
});

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Email Verification Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/email/verify', EmailVerification::class)->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('admin.dashboard');
    })->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware(['throttle:6,1'])->name('verification.send');
});

/*
|--------------------------------------------------------------------------
| Admin Panel Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/', AdminDashboard::class)->name('dashboard');

    // Settings
    Route::get('/settings/{group?}', AdminSettings::class)->name('settings');

    // User Management
    Route::get('/users', AdminUserList::class)->name('users');
    Route::get('/users/create', AdminUserForm::class)->name('users.create');
    Route::get('/users/{userId}/edit', AdminUserForm::class)->name('users.edit');

    // Activity Log
    Route::get('/activity-log', AdminActivityLog::class)->name('activity-log');

    // Pages
    Route::get('/pages', AdminPageList::class)->name('pages.index');
    Route::get('/pages/create', AdminPageForm::class)->name('pages.create');
    Route::get('/pages/{pageId}/edit', AdminPageForm::class)->name('pages.edit');

    // Hero Slides
    Route::get('/hero-slides', AdminHeroSlideList::class)->name('hero-slides.index');
    Route::get('/hero-slides/create', AdminHeroSlideForm::class)->name('hero-slides.create');
    Route::get('/hero-slides/{heroSlideId}/edit', AdminHeroSlideForm::class)->name('hero-slides.edit');

    // Statistics
    Route::get('/statistics', AdminStatisticList::class)->name('statistics.index');
    Route::get('/statistics/create', AdminStatisticForm::class)->name('statistics.create');
    Route::get('/statistics/{statisticId}/edit', AdminStatisticForm::class)->name('statistics.edit');

    // Testimonials
    Route::get('/testimonials', AdminTestimonialList::class)->name('testimonials.index');
    Route::get('/testimonials/create', AdminTestimonialForm::class)->name('testimonials.create');
    Route::get('/testimonials/{testimonialId}/edit', AdminTestimonialForm::class)->name('testimonials.edit');

    // Call to Actions
    Route::get('/call-to-actions', AdminCtaList::class)->name('cta.index');
    Route::get('/call-to-actions/create', AdminCtaForm::class)->name('cta.create');
    Route::get('/call-to-actions/{ctaId}/edit', AdminCtaForm::class)->name('cta.edit');

    // Featured Sections
    Route::get('/featured-sections', AdminFeaturedSectionList::class)->name('featured-sections.index');
    Route::get('/featured-sections/create', AdminFeaturedSectionForm::class)->name('featured-sections.create');
    Route::get('/featured-sections/{sectionId}/edit', AdminFeaturedSectionForm::class)->name('featured-sections.edit');

    // News
    Route::get('/news', AdminNewsList::class)->name('news.index');
    Route::get('/news/create', AdminNewsForm::class)->name('news.create');
    Route::get('/news/{newsId}/edit', AdminNewsForm::class)->name('news.edit');

    // Blog Posts
    Route::get('/posts', AdminPostList::class)->name('posts.index');
    Route::get('/posts/create', AdminPostForm::class)->name('posts.create');
    Route::get('/posts/{postId}/edit', AdminPostForm::class)->name('posts.edit');

    // Categories
    Route::get('/categories', AdminCategoryList::class)->name('categories.index');
    Route::get('/categories/create', AdminCategoryForm::class)->name('categories.create');
    Route::get('/categories/{categoryId}/edit', AdminCategoryForm::class)->name('categories.edit');

    // Tags
    Route::get('/tags', AdminTagList::class)->name('tags.index');
    Route::get('/tags/create', AdminTagForm::class)->name('tags.create');
    Route::get('/tags/{tagId}/edit', AdminTagForm::class)->name('tags.edit');

    // Comments
    Route::get('/comments', AdminCommentList::class)->name('comments.index');

    // Gallery
    Route::get('/galleries', AdminGalleryList::class)->name('galleries.index');
    Route::get('/galleries/create', AdminGalleryForm::class)->name('galleries.create');
    Route::get('/galleries/{galleryId}/edit', AdminGalleryForm::class)->name('galleries.edit');

    // Downloads
    Route::get('/downloads', AdminDownloadList::class)->name('downloads.index');
    Route::get('/downloads/create', AdminDownloadForm::class)->name('downloads.create');
    Route::get('/downloads/{downloadId}/edit', AdminDownloadForm::class)->name('downloads.edit');

    // Partners
    Route::get('/partners', AdminPartnerList::class)->name('partners.index');
    Route::get('/partners/create', AdminPartnerForm::class)->name('partners.create');
    Route::get('/partners/{partnerId}/edit', AdminPartnerForm::class)->name('partners.edit');

    // Council Members
    Route::get('/council', AdminCouncilList::class)->name('council.index');
    Route::get('/council/create', AdminCouncilForm::class)->name('council.create');
    Route::get('/council/{councilMemberId}/edit', AdminCouncilForm::class)->name('council.edit');

    // Contact Messages
    Route::get('/contact-messages', AdminContactList::class)->name('contact-messages.index');

    // Newsletter Subscribers
    Route::get('/newsletter', AdminSubscriberList::class)->name('newsletter.index');

    // FAQs
    Route::get('/faqs', AdminFaqList::class)->name('faqs.index');
    Route::get('/faqs/create', AdminFaqForm::class)->name('faqs.create');
    Route::get('/faqs/{faqId}/edit', AdminFaqForm::class)->name('faqs.edit');

    // Menus
    Route::get('/menus', AdminMenuManager::class)->name('menus.index');
});

/*
|--------------------------------------------------------------------------
| Member Portal Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->prefix('member')->name('member.')->group(function () {
    Route::get('/', MemberDashboard::class)->name('dashboard');
    Route::get('/profile', ProfileManager::class)->name('profile');
    
    // Membership
    Route::get('/membership/apply', MembershipApply::class)->name('membership.apply');
    Route::get('/membership/status', MembershipStatus::class)->name('membership.status');
    
    // Events
    Route::get('/events', EventCatalog::class)->name('events.index');
    Route::get('/events/{event:slug}', EventDetails::class)->name('events.show');
    Route::get('/my-events', MyEvents::class)->name('events.mine');
});
