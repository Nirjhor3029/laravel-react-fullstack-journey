function Button({ text = 'Click Me', type = 'primary' }) {
    return (
        <button
            style={{
                backgroundColor: type === 'primary' ? '#007bff' : '#dc3545',
                borderColor: type === 'primary' ? '#007bff' : '#dc3545',
                color: 'white',
                padding: '10px 20px',
                borderRadius: '5px',
            }}
        >
            {text}
        </button>
    );
}

export default Button;
