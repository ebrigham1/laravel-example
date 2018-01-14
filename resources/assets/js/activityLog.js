Echo.channel('ActivityLog')
    .listen('ActivityLogCreated', (event) => {
        console.log(event);
    });