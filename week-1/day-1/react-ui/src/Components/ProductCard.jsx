function ProductCard({ name, price }) {
    return (
        <div className="product-card">
            <h2>{name}</h2>
            <p>Price: ${price}</p>
            <button>Buy Now</button>
        </div>
    );
}

export default ProductCard;

