const ActivityLogFactory = require('./components/activityLog.js');
require('./bootstrapEcho');
const jQueryBridget = require('jquery-bridget');
const InfiniteScroll = require('infinite-scroll');

// Make Infinite Scroll a jQuery plugin
jQueryBridget('infiniteScroll', InfiniteScroll, $);

// Listen to the ActivityLog channel to update activities in real time
Echo.channel('ActivityLog')
    .listen('.ActivityLogCreated', (data) => {
        ActivityLogFactory.create(data.userName, data.createdAt, data.description);
    });

/*let infiniteScroll = $('div#activityLogs').infiniteScroll({
    path: 'ul.pagination > li.active + li > a',
    responseType: 'text',
    hideNav: 'ul.pagination',
    history: false,
});

infiniteScroll.on('load.infiniteScroll', function(event, response) {
    // parse response into JSON data
    let data = JSON.parse(response);
    // compile data into HTML
    let itemsHTML = data.map( getItemHTML ).join('');
    // convert HTML string into elements
    let items =  $(itemsHTML);
    // append item elements
    $(this).infiniteScroll('appendItems', items);
});*/