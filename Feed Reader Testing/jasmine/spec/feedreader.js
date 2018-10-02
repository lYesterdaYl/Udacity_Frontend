/* feedreader.js
 *
 * This is the spec file that Jasmine will read and contains
 * all of the tests that will be run against your application.
 */

$(function() {

    describe('RSS Feeds', function() {
        //check if allFeeds is defined and not empty
        it('should be defined', function() {
            expect(allFeeds).toBeDefined();
            expect(allFeeds.length).not.toBe(0);
        });


        //check if items in allFeeds's url are defined and not empty
        it('URLs should be defined and not empty', function () {
           for (feed of allFeeds){
               expect(feed.url).toBeDefined();
               expect(feed.url).not.toBe('');
           }
        });

        //check if items in allFeeds's name are defined and not empty
        it('names should be defined and not empty', function () {
            for (feed of allFeeds){
                expect(feed.name).toBeDefined();
                expect(feed.name).not.toBe('');
            }
        });

    });



    describe('The menu', function () {
        let menu = document.querySelector('body');

        //check if menu is hidden by default
        it('should be hidden by default', function () {
            let class_name_array = menu.className.split(" ");
            expect(class_name_array.includes('menu-hidden')).toBe(true);
        });

         //check if menu icon is functional for hide and display the menu
        it('should be clickable for the menu displayed or hidden', function () {
            //get all class names from body and check if it should or should not have menu-hidden class name after click
            $('.menu-icon-link').click();
            let class_name_array1 = menu.className.split(" ");
            expect(class_name_array1.includes('menu-hidden')).toBe(false);

            $('.menu-icon-link').click();
            let class_name_array2 = menu.className.split(" ");
            expect(class_name_array2.includes('menu-hidden')).toBe(true);
        });
    });

    describe('Intial Entries', function () {
        beforeEach(function (done) {
            loadFeed(0, function (done) {
                done();
            });
        });

        //check if .feed container works as intended.
        it('should have at least a single .entry element within the .feed container', function () {
            expect($('.feed .entry').length).toBeGreaterThan(0);
        });
    });

    describe('New Feed Selection', function () {

        let old_feed = ''; //initialize variable for old feed

        beforeEach(function(done) {
            loadFeed(0, function() {
                //store the current feed to the old_feed
                old_feed = $('.feed').html();
                //load another feed with other arguements
                loadFeed(2, done);
            });
        });

        //check if loadFeed actually loads different contents.
        it('should be changed by the loadFeed function', function () {
            //compare old and current feed html.
            expect($('.feed').html()).not.toBe(old_feed);
        });
    });

}());
