import { useState } from "react";
import Button from "./Button";
import "./UserCard.css";

function UserCard({ name, role }) {
    const [count, setCount] = useState(0);
    return (
        <div className="card">
            <div className="card-header">
                <h2>{name}</h2>
            </div>
            <div className="card-body">
                <p className="card-text">Role: {role}</p>
                <h1>Count: {count}</h1>
                <button onClick={() => setCount(count + 1)}>Increment</button>
            </div>
            <div>
                {/* Usage */}
                <Button /> {/*Click Me (default)*/}
                <Button text="Submit" /> {/* Submit*/}
                <Button text="Cancel" type="danger" /> {/* Cancel*/}
            </div>
        </div>
    );
}

export default UserCard;
