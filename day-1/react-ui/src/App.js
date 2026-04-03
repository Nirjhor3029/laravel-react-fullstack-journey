import Card from "./Components/Card";
import PaymentCard from "./Components/PaymentCard";
import ProductCard from "./Components/ProductCard";
import User from "./Components/UserCard";


function App() {
  return (
    <div className="App">
      <h1>Hello React</h1>

      <Card />
      <Card />

      <User name="Nirjhor" />

      <PaymentCard amount={300} />
      <PaymentCard amount={100} />
      <PaymentCard amount={6000} />

      
      <ProductCard name="Laptop" price={999} />
      <ProductCard name="Phone" price={699} />
    </div>
  );
}

export default App;
