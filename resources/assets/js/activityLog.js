const ActivityLogFactory = require('./components/ActivityLogFactory.js');
require('./bootstrapEcho');
const InfiniteScroll = require('infinite-scroll');
let activityLogsContainer = $('#activityLogs');
let noActivitiesContainer = $('#noActivities');

// Listen to the ActivityLog channel to update activities in real time
Echo.channel('ActivityLog')
    .listen('.ActivityLogCreated', (activityLog) => {
        // If we don't have any activity logs clear out the div
        if (noActivitiesContainer.length) {
            noActivitiesContainer.slideUp(500, function() {
                noActivitiesContainer.remove();
            });
        }
        ActivityLogFactory.createAndPrepend(
            activityLogsContainer,
            activityLog.user_name,
            activityLog.created_at_diff_for_humans,
            activityLog.description
        );
    });

// If we have multiple pages set up infinite scroll
if (activityLogsContainer.data('hasMorePages')) {
    let infiniteScroll = new InfiniteScroll('#activityLogs', {
        path: function() {
            let nextPageIndex = this.pageIndex + 1;
            if (activityLogsContainer.data('lastPageIndex') >= nextPageIndex) {
                return activityLogsContainer.data('baseAjaxUrl') + '?page=' + nextPageIndex;
            }
        },
        responseType: 'text',
        append: false,
        history: false,
        status: '.page-load-status',
        debug: true,
    });
    infiniteScroll.on('load', function(response) {
        let data = JSON.parse(response);
        let activityLogs = data.data;
        for (let activityLog of activityLogs) {
            ActivityLogFactory.createAndAppend(
                activityLogsContainer,
                activityLog.user.name,
                activityLog.created_at_diff_for_humans,
                activityLog.description
            );
        }
    });
}


