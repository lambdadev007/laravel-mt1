<?php
namespace App\Http\Controllers;

// * Included Models
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Session;
// * Included Models

Class TranslationCT {
    public $global = [
        'ka' => [
            // * General
                'html_title'                        => 'მეტრიქსი - სამშენებლო სარემონტო კომპანია, გაზომე ხარისხი',

                'title'                             => 'სათაური',
                'description'                       => 'აღწერა',

                'call_request'                      => 'ზარის შეკვეთა',
                
                'user_profile'                      => 'მომხმარებლის პროფილი',

                'unit'                              => 'ცალი',
                'price'                             => 'ფასი',
                'sum'                               => 'სულ',
                'total'                             => 'ჯამი',

                'add'                               => 'დამატება',
                'view'                              => 'ნახვა',
                'views'                             => 'ნახვები',
                'author'                            => 'ავტორი',
                'valid'                             => 'ძალაშია',
                'read_more'                         => 'ვრცლად',
                'similar'                           => 'მსგავსი',
                'payment'                           => 'გადახდა',

                'input_code'                        => 'შეიყვანეთ კოდი',
                'finish_request'                    => 'შეკვეთის დასრულება',
            // * General

            // * Pages and Sorting
                'homepage'                          => 'მთავარი გვერდი',
                'services'                          => 'მომსახურება',
                'design'                            => 'დიზაინი',
                'online_market'                     => 'ONLINE-მარკეტი',
                'all'                               => 'ყველა',
                'materials'                         => 'მასალები',
                'consultation'                      => 'კონსულტაცია',
                'designer'                          => 'დიზაინერი',
                'repairs'                           => 'რემონტი',
                'furniture'                         => 'ავეჯი',
                'vip_master'                        => 'VIP-მასტერი',
                'cleaning'                          => 'დასუფთავება',

                'vacancies'                         => 'ვაკანსიები',
                'contact'                           => 'კონტაქტი',

                'offers-title'                      => 'აქციები და სპეციალური შეთავაზებები',
                'articles-title'                    => 'პოპულარული სტატიები და რჩევები',
                'partners-title'                    => 'ჩვენი პარტნიორები',

                'offers'                            => 'აქციები',
                'articles'                          => 'რჩევები და სტატიები',
                'projects'                          => 'ნამუშევრები',
            // * Pages and Sorting

            // * About us
                'about_us'                          => 'ჩვენს შესახებ',
                'company'                           => 'კომპანია',
                'team'                              => 'გუნდი',
                'mission'                           => 'მისია',
            // * About us

            // * Ordering and Registration
                'terms'                             => 'პირობები',
                'terms_of_payment'                  => 'გადახდის პირობები',
                'delivery_conditions'               => 'ადგილზე მიტანის პირობები',
                'how_to_become_a_supplier'          => 'როგორ გავხდეთ მომწოდებელი',
                'contact_information'               => 'საკონტაქტო ინფორმაცია',

                'order_price'                       => 'შეკვეთის ღირებულება',
                'order_product'                     => 'შეკვეთის გაფორმება',

                'terms_of_purchase'                 => 'შეკვეთის პირობები',
                'terms_of_purchase_text'            => 'გამოიყენება მშენებლობასა და სახლში ხის ნაკეთობების, პარკეტის, შპალერის და ა.შ. მიწებებისთვის. მისაწებებელი ზედაპირი უნდა იყო სუფთა, მშრალი, თავისუფალი მტვერის და ზეთოვანი ლაქებისაგან.',
                'required_inputs'                   => '*-ით მონიშნული ველების შევსება აუცილებელია..',

                'specify'                           => 'მიუთითეთ',
                'name'                              => 'სახელი',
                'lname'                             => 'გვარი',
                'number'                            => 'ტელ. ნომერი',
                'city'                              => 'ქალაქი',
                'region'                            => 'რეგიონი',
                'address'                           => 'მისამართი',
                'address_info'                      => 'ქალაქი, რაიონი, სრული მისამართი',

                'get_in_touch'                      => 'როდის დაგიკავშირდეთ?',
                'asap'                              => 'დაუყოვნებლივ',
                'agreement_before_visiting'         => 'დრო შემითანხმეთ ვიზიტამდე',

                'i_agree_to_register'               => 'ვეთანხმები',
                'i_agree_to'                        => 'ვეთანხმები შეკვეთის გაფორმების',
                'these_terms_and_conditions'        => 'წესებს და პირობებს',
            // * Ordering and Registration

            // * Furniture
                'kitchen'                           => 'სამზარეულო',
                'reception'                         => 'მისაღები',
                'childrens_room'                    => 'საბავშვო',
                'sleeping_room'                     => 'საძინებელი',
                'office_furniture'                  => 'საოფისე',
                'soft_furniture'                    => 'რბილი ავეჯი',
                'projects_works'                    => 'პროექტები და ნამუშევრები',
                'furniture_materials'               => 'ფურნიტურა და მასალები',
            // * Furniture

            // * Navbar
                'private_cabinet'                   => 'პირადი კაბინეტი',
                'user_profile'                      => 'მომხმარებლის პროფილი',
                'purchase_history'                  => 'შეკვეთების ისტორია',
                'change_password'                   => 'პაროლის შეცვლა',
                'compare_products'                  => 'შედარების სია',
                'wishlist'                          => 'სურვილების სია',
                
                'search_word'                       => 'საძიებო სიტყვა',

                'login'                             => 'შესვლა',
                'logout'                            => 'გამოსვლა',
                'register'                          => 'რეგისტრაცია',
                'password'                          => 'პაროლი',
                'remember_me'                       => 'დამიმახსოვრე',
                'forgot_password'                   => 'დაგავიწყდათ პაროლი ?',
            // * Navbar

            // * Products
                'our_production'                    => 'ჩვენი პროდუქცია',

                'newly_added'                       => 'ახალი დამატებული',
                'products_with_a_discount'          => 'პროდუქცია ფასდაკლებით',
                'popular_products'                  => 'პოპულარული პროდუქტი',
                'last_viewed'                       => 'ბოლოს ნანახი',
                'all_products'                      => 'ყველა პრდუქტი',

                'manufacturer'                      => 'მწარმოებელი',
                'place_of_production'               => 'წარმოების ადგილი',
                'volume'                            => 'მოცულობა',
                'product_code'                      => 'პროდუქტის კოდი',

                'product_description'               => 'პროდუქტის აღწერა',
                'see_all'                           => 'სრულად ნახვა',
                
                'terms_of_delivery_header'          => 'ადგილზე მიტანის პირობები',
                'terms_of_delivery_1'               => '800 ლარის შენაძენზე, თბილისის მასშტაბით ადგილზე მიტანა უფასოდ',
                'terms_of_delivery_2'               => '2-4 დღის ვადაში, თბილისის მასშტაბით- 5 ლარი',
                'terms_of_delivery_3'               => '1 დღის ვადაში, თბილისის მასშტაბით- 10 ლარი',
                'terms_of_delivery_footer'          => 'რეგიონებში მიწოდების ვადები და პირობები გთხოვთ შეათანხმოთ ადმინისტრაციასთან',
            // * Products
        ],
        'en' => [
            // * General
                'html_title'                        => 'Metrix - Construction and Maintenance Company, Measure the quality',

                'title'                             => 'Title',
                'description'                       => 'Description',

                'call_request'                      => 'Request a call',

                'user_profile'                      => 'User Profile',

                'add'                               => 'Add',
                'unit'                              => 'Unit',
                'price'                             => 'Price',
                'sum'                               => 'Sum',
                'total'                             => 'Total',

                'view'                              => 'View',
                'views'                             => 'Views',
                'author'                            => 'Author',
                'valid'                             => 'Valid untill',
                'read_more'                         => 'Read More',

                'similar'                           => 'Similar',
                'payment'                           => 'Payment',

                'input_code'                        => 'Input code',
                'finish_request'                    => 'Finish the request',
            // * General

            // * Pages and Sorting
                'homepage'                          => 'Homepage',
                'services'                          => 'Services',
                'design'                            => 'Design',
                'online_market'                     => 'ONLINE-Market',
                'all'                               => 'All',
                'materials'                         => 'Materials',
                'consultation'                      => 'Consultation',
                'designer'                          => 'Designer',
                'repairs'                           => 'Repairs',
                'furniture'                         => 'Furniture',
                'vip_master'                        => 'VIP-Master',
                'cleaning'                          => 'Cleaning',

                'vacancies'                         => 'Vacancies',
                'contact'                           => 'Contact',

                'offers'                            => 'Offers',
                'articles'                          => 'Articles and tips',
                'projects'                          => 'Works',

                'offers-title'                      => 'Promotions and special offers',
                'articles-title'                    => 'Popular articles and tips',
                'partners-title'                    => 'Our partners',
            // * Pages and Sorting

            // * About us
                'about_us'                          => 'About us',
                'company'                           => 'Our Company',
                'team'                              => 'Our Team',
                'mission'                           => 'Our Mission',
            // * About us

            // * Ordering and Registration
                'terms'                             => 'Terms',
                'terms_of_payment'                  => 'Terms of payment',
                'delivery_conditions'               => 'Delivery Conditions',
                'how_to_become_a_supplier'          => 'How to become a supplier',
                'contact_information'               => 'Contact information',

                'order_price'                       => 'Order Price',
                'order_product'                     => 'Order product',

                'terms_of_purchase'                 => 'Ordering conditions',
                'terms_of_purchase_text'            => 'Used in construction and homes made of wood, parquet, wallpaper, etc. For lands. The adhesive surface should be clean, dry, free from dust and oily spots.',
                'required_inputs'                   => 'Fields marked with an * are required.',

                'specify'                           => 'Specify',
                'name'                              => 'Name',
                'lname'                             => 'Last name',
                'number'                            => 'Mob. Number',
                'city'                              => 'City',
                'region'                            => 'Region',
                'address'                           => 'Address',
                'address_info'                      => 'City, Region, full address',

                'get_in_touch'                      => 'When should we get in touch?',
                'asap'                              => 'As soon as possible',
                'agreement_before_visiting'         => 'Agreement before our visit',

                'i_agree_to'                        => 'I agree to these',
                'these_terms_and_conditions'        => 'terms and conditions',
            // * Ordering and Registration

            // * Furniture
                'kitchen'                           => 'Kitchen',
                'reception'                         => 'Reception',
                'childrens_room'                    => 'Childrens room',
                'sleeping_room'                     => 'Sleeping room',
                'office_furniture'                  => 'Office furniture',
                'soft_furniture'                    => 'Soft furniture',
                'projects_works'                    => 'Projects and works',
                'furniture_materials'               => 'Furniture and Materials',
            // * Furniture

            // * Navbar
                'private_cabinet'                   => 'Private Cabinet',
                'user_profile'                      => 'User Profile',
                'purchase_history'                  => 'Purchase History',
                'change_password'                   => 'Change Password',
                'compare_products'                  => 'Compare Products',
                'wishlist'                          => 'Wishlist',

                'search_word'                       => 'Search Word',

                'login'                             => 'Log in',
                'logout'                            => 'Log out',
                'register'                          => 'Register',
                'password'                          => 'Password',
                'remember_me'                       => 'Remember me',
                'forgot_password'                   => 'Forgot your password?',
            // * Navbar

            // * Products
                'our_production'                    => 'Our Production',

                'newly_added'                       => 'Newly added',
                'products_with_a_discount'          => 'Products with a discount',
                'popular_products'                  => 'Popular products',
                'last_viewed'                       => 'Last viewed',
                'all_products'                      => 'All products',

                'manufacturer'                      => 'Manufacturer',
                'place_of_production'               => 'Place of production',
                'volume'                            => 'Volume',
                'product_code'                      => 'Product code',

                'product_description'               => 'Description',
                'see_all'                           => 'View all',
                
                'terms_of_delivery_header'          => 'Delivery Conditions',
                'terms_of_delivery_1'               => 'Free delivery across Tbilisi on purchases of up to 800 GEL',
                'terms_of_delivery_2'               => 'Delivery in 2-4 days across Tbilisi - 5 GEL',
                'terms_of_delivery_3'               => 'Delivery in 1 day across Tbilisi - 10 GEL',
                'terms_of_delivery_footer'          => 'Please agree with the administration on Terms and conditions of delivery in the regions',
             // * Products
        ]
    ];

    public function T($local, $keyword) {
        return $local[Session::get('locale')][$keyword] .' ';
    }

    public function TG($keyword) {
        return $this->global[Session::get('locale')][$keyword] .' ';
    }
}