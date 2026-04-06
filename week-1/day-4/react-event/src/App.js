import './App.css';
import Counter from './components/Counter';
import InteractiveList from './components/InteractiveList';
import LoginForm from './components/LoginForm';
import NameInput from './components/NameInput';


function App() {
  return (
    <div className="App">
      <header className="App-header">
        <Counter />
        <NameInput />
        <LoginForm/>

        <InteractiveList />
      </header>
    </div>
  );
}

export default App;
