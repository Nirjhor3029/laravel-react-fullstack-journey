import { useState } from "react";

function InteractiveList() {
    const [items, setItems] = useState(["Item 1", "Item 2"]);
    const [newItem, setNewItem] = useState("");

    function addItem() {
        if (newItem.trim()) {
            setItems([...items, newItem]);
            setNewItem("");
        }
    }

    function removeItem(index) {
        setItems(items.filter((_, i) => i !== index));
    }

    return (
        <div>
            <input
                value={newItem}
                onChange={(e) => setNewItem(e.target.value)}
                placeholder="New item"
            />
            <button onClick={addItem}>Add</button>
            <ul>
                {items.map((item, index) => (
                    <li key={index}>
                        {item}
                        <button onClick={() => removeItem(index)}>Remove</button>
                    </li>
                ))}
            </ul>
        </div>
    );
}

export default InteractiveList;