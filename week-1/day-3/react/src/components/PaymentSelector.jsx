import { useState } from "react";

function PaymentSelector() {
    const [gateway, setGateway] = useState("Bkash");
    const [amount, setAmount] = useState(0);

    const handlePayment = () => {
        alert(`Processing ${amount} via ${gateway}`);
    };

    return (
        <>
            <div>
                <h2>Select Payment Method</h2>

                <div className="gateways">
                    <button
                        onClick={() => setGateway("Bkash")}
                        className={gateway === "Bkash" ? "active" : ""}
                    >
                        Bkash
                    </button>

                    <button
                        onClick={() => setGateway("Nagad")}
                        className={gateway === "Nagad" ? "active" : ""}
                    >
                        Nagad
                    </button>

                    <button
                        onClick={() => setGateway("Card")}
                        className={gateway === "Card" ? "active" : ""}
                    >
                        Card
                    </button>
                </div>

                <p>Selected: {gateway}</p>

                <input
                    type="number"
                    value={amount}
                    onChange={(e) => setAmount(e.target.value)}
                    placeholder="Enter amount"
                />

                <button onClick={handlePayment}>Pay {amount}</button>
            </div>
        </>
    );
}

export default PaymentSelector;
