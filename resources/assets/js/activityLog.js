const ActivityLogFactory = require('./components/activityLog.js');
require('./bootstrapEcho');
const InfiniteScroll = require('infinite-scroll');

// Listen to the ActivityLog channel to update activities in real time
Echo.channel('ActivityLog')
    .listen('.ActivityLogCreated', (activityLog) => {
        ActivityLogFactory.createAndPrepend(
            activityLog.userName,
            activityLog.createdAt,
            activityLog.description
        );
    });

// If we have multiple pages set up infinite scroll
let activityLogs = $('#activityLogs');
if (activityLogs.data('hasMorePages')) {
    let infiniteScroll = new InfiniteScroll('#activityLogs', {
        path: function() {
            let nextPageIndex = this.pageIndex + 1;
            if (activityLogs.data('lastPageIndex') >= nextPageIndex) {
                return activityLogs.data('baseAjaxUrl') + '?page=' + nextPageIndex;
            }
        },
        responseType: 'text',
        append: false,
        hideNav: 'ul.pagination',
        history: false,
        debug: true,
    });
    infiniteScroll.on('load', function(response) {
        let data = JSON.parse(response);
        let activityLogs = data.data;
        for (let activityLog of activityLogs) {
            ActivityLogFactory.createAndAppend(
                activityLog.user.name,
                activityLog.created_at,
                activityLog.description
            );
        }
    });
}


