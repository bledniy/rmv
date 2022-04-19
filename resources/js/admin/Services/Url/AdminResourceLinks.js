
export default class AdminResourceLinks {
    static user(user) {
        return {
            edit() {
                return `/admin/users/${user.id}/edit`;
            }
        }
    }

    static order($order = null) {
        return {
            preview() {
                return Hosts.frontHost() + `/orders/${$order.slug}`;
            },
            toggleActive() {
                return `/admin/orders/${$order.id}/active`;
            },
            delete() {
                return `/admin/orders/${$order.id}`;
            },
            update(orderId) {
                return this.show(orderId);
            },
            list() {
                return `/admin/orders`;
            },
            show(orderId) {
                return `/admin/orders/${orderId}`;
            },
            bids(orderId) {
                return {
                    show() {
                        return `/admin/orders/${orderId}/bids`;
                    },
                    delete(bidId) {
                        return `/admin/orders/${orderId}/bids/${bidId}`
                    }
                }
            },
            chat($chatId) {
                return `/admin/orders/${$order.id}/chats/${$chatId}`
            },
            chatLoadMessages($chatId) {
                return `/admin/orders/${$order.id}/chats/${$chatId}/load`
            }
        }
    }

}