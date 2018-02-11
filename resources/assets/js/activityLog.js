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
        // Use the factory to add the activity log
        ActivityLogFactory.createAndPrepend(
            activityLogsContainer,
            activityLog.user_name,
            activityLog.created_at_diff_for_humans,
            activityLog.description
        );
    });

// If we have multiple pages set up infinite scroll
// If we have more pages is stored as a data attribute on the activity log container
if (activityLogsContainer.data('hasMorePages')) {
    let infiniteScroll = new InfiniteScroll('#activityLogs', {
        // Path to get the next page
        path: function() {
            let nextPageIndex = this.pageIndex + 1;
            // If we don't have a next page don't return a url
            if (activityLogsContainer.data('lastPageIndex') >= nextPageIndex) {
                // Base url for next page stored as a data attribute on the activity log container
                return activityLogsContainer.data('baseAjaxUrl') + '?page=' + nextPageIndex;
            }
        },
        // Response type text for json
        responseType: 'text',
        // Don't append becuase we will be doing it manually in the load function with the json we get back
        append: false,
        // Don't affect browser history (this would be a nice addition at some point
        history: false,
    });
    // Infinite scroll load event (when data is loaded from the ajax endpoint
    infiniteScroll.on('load', function(response) {
        // Parse the json data
        let data = JSON.parse(response);
        // Get activity logs from it
        let activityLogs = data.data;
        // Loop through activity logs
        for (let activityLog of activityLogs) {
            // Use the factory to add the activity log element
            ActivityLogFactory.createAndAppend(
                activityLogsContainer,
                activityLog.user.name,
                activityLog.created_at_diff_for_humans,
                activityLog.description
            );
        }
    });
}