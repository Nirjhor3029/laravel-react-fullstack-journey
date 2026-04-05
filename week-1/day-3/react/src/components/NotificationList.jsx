import { useState } from "react";

function NotificationList() {
    const [notifications, setNotifications] = useState([
        { id: 1, type: 'Email', message: 'Welcome!' },
        { id: 2, type: 'SMS', message: 'Your code is 1234' }
    ]);
    
    const addNotification = () => {
        const newNotif = {
            id: notifications.length + 1,
            type: 'Push',
            message: 'New notification'
        };
        setNotifications([...notifications, newNotif]);
    };
    
    return (
        <div>
            {notifications.map(notif => (
                <div key={notif.id}>
                    <h3>{notif.type}</h3>
                    <p>{notif.message}</p>
                </div>
            ))}
            
            <button onClick={addNotification}>
                Add Notification
            </button>
        </div>
    );
}

export default NotificationList;