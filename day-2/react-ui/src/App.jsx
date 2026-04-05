import "./App.css";
import UserCard from "./UserCard";

function App() {
    return (
        <>
            <UserCard name="Nirjhor" role="Admin" />
            <UserCard name="Sazzad" role="Developer" />
            <UserCard name="Rahim" role="Designer" />
        </>
    );
}

export default App;
