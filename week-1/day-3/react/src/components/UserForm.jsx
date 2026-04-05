import { useState } from "react";

function UserForm() {
    const [name, setName] = useState("");
    const [email, setEmail] = useState("");
    const [isSubmitted, setIsSubmitted] = useState(false);
    
    const handleSubmit = (e) => {
        e.preventDefault();
        setIsSubmitted(true);
    };
    
    if (isSubmitted) {
        return (
            <div>
                <h2>Thank you, {name}!</h2>
                <p>Email: {email}</p>
            </div>
        );
    }
    
    return (
        <form onSubmit={handleSubmit}>
            <input 
                value={name}
                onChange={(e) => setName(e.target.value)}
                placeholder="Name"
            />
            <input 
                value={email}
                onChange={(e) => setEmail(e.target.value)}
                placeholder="Email"
            />
            <button type="submit">Submit</button>
        </form>
    );
}

export default UserForm;