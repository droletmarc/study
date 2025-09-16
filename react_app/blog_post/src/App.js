import './index.css';
import { useState, useEffect } from 'react';
import Form from './Form';
import Table from './Table';

function App() {
  const API_URL = 'https://jsonplaceholder.typicode.com/'

  const menuTypes = ['users', 'posts', 'comments']
  const [reqType, setReqType] = useState(menuTypes[0])
  const [items, setItems] = useState([]);

  useEffect(() => {
    const fetchItems = async () => {
      try {
        const response = await fetch(`${API_URL}/${reqType}`)
        if (!response.ok) throw Error('Unable to fetch data')
        const data = await response.json()
        setItems(data)
      } catch (err) {
        console.error(err)
      }
    }

    fetchItems()
  }, [reqType])

  return (
    <div className="App">
      <Form menuTypes={menuTypes} reqType={reqType} setReqType={setReqType} />
      <Table items={items} />
    </div>
  );
}

export default App;
