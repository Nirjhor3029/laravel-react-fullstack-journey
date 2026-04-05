
import "./App.css";
import Counter from "./components/Counter";
import NotificationList from "./components/NotificationList";
import PaymentSelector from "./components/PaymentSelector";
import UserForm from "./components/UserForm";

function App() {

    return (
        <>
            <Counter/>
            <PaymentSelector/>

            <NotificationList/>

            <UserForm/>
        </>
    );
}

export default App;
