import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/nav1.css',
                'resources/css/footer.css',
                'resources/css/home.css',
                'resources/css/partners.css',
                'resources/css/pricing.css',
                'resources/css/services.css',
                'resources/css/signup.css',
                'resources/css/sigin.css',
                'resources/css/contact.css',
                'resources/css/solutions.css',
                'resources/css/standard.css',
                'resources/css/personal-solutions.css',
                'resources/css/dashboard.css',
                'resources/css/admin_dashboard.css',
                'resources/css/admin_review.css',
                'resources/css/basic.css',
                'resources/css/compare.css',
                'resources/css/more.css',
                'resources/css/more-nav.css',
                'resources/css/user_payment.css',
                'resources/css/premium.css',
                'resources/css/loading.css',
                'resources/css/learn_more_personal_solutions.css',
                'resources/css/learn_more_services.css',
                'resources/css/learn_more_solutions.css',
                'resources/css/learn_more_events.css',
                

               'resources/vendor/fontawesome/css/all.min.css',
               'public/css/app.css',
               'resources/vendor/bootstrap/css/bootstrap.min.css',


               
                'resources/js/clock.js',
                'resources/js/admin_profile.js',
                'resources/js/admin_dashboard.js',],
            refresh: true,
        }),
    ],
});
