import { useState } from "react";

function Counter() {
    const [count, setCount] = useState(0);

    return (
        <>
            <div className="cenetr">
                <h3>Counter</h3>
                <p>by that we learn useState hooks</p>
                <br />
                <button onClick={() => setCount(count + 1)}>
                    Count: {count}
                </button>
            </div>
        </>
    );
}

export default Counter;
