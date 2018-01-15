const ActivityLogFactory = require('./components/activityLog.js');
require('./bootstrapEcho');

Echo.channel('ActivityLog')
    .listen('.ActivityLogCreated', (data) => {
        ActivityLogFactory.create(data.userName, data.createdAt, data.description);
    });