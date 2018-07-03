/**
 * Handles activity log dom elements
 */
class ActivityLogFactory
{
    /**
     * Create an activity log dom element
     *
     * @param {jQuery} container
     * @param {string} userName
     * @param {string} createdAt
     * @param {string} description
     * @returns {void}
     */
    static createAndAppend(container, userName, createdAt, description) {
        let activityLog = this.createContainer(userName, createdAt, description, false);
        // Append the new activity to the logs
        container.append(activityLog);
    }

    /**
     * Create an activity log dom element
     *
     * @param {jQuery} container
     * @param {string} userName
     * @param {string} createdAt
     * @param {string} description
     * @returns {void}
     */
    static createAndPrepend(container, userName, createdAt, description) {
        let activityLog = this.createContainer(userName, createdAt, description);
        // Prepend the new activity to the logs
        container.prepend(activityLog);
        activityLog.slideDown(500);
    }

    /**
     * Create an activity log container element
     *
     * @param {string} userName
     * @param {string} createdAt
     * @param {string} description
     * @param {boolean} hide
     * @returns {jQuery}
     */
    static createContainer(userName, createdAt, description, hide = true) {
        let element = $("<div>", {
            'class': 'list-group-item',
        });
        if (hide) {
            element.css('display', 'none');
        }
        return element.append(this.createHeadingContainer(userName, createdAt))
            .append(this.createDescription(description));
    }

    /**
     * Create an activity log heading container
     *
     * @param {string} userName
     * @param {string} createdAt
     * @returns {jQuery}
     */
    static createHeadingContainer(userName, createdAt)
    {
        return $('<div>', {
            'class': 'd-flex w-100 justify-content-between',
        }).append(this.createHeading(userName, createdAt)).append(this.createDate(createdAt));
    }

    /**
     * Create an activity log heading element
     *
     * @param {string} userName
     * @returns {jQuery}
     */
    static createHeading(userName)
    {
        return $('<h4>', {
            'class': 'mb-1',
            'text': userName
        });
    }

    /**
     * Create an activity log date element
     *
     * @param {string} createdAt
     * @returns {jQuery}
     */
    static createDate(createdAt)
    {
        return $('<span>', {
            'class': 'text-muted',
            'text': createdAt
        });
    }

    /**
     * Create an activity log description element
     *
     * @param {string} description
     * @returns {jQuery}
     */
    static createDescription(description)
    {
        return $('<p/>', {
            'class': 'mb-1',
            'text': description
        });
    }
}
module.exports = ActivityLogFactory;