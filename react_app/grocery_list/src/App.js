import './index.css';
import { useState, useEffect } from 'react';
import Header from './Header';
import SearchItem from './SearchItem';
import AddItem from './AddItem';
import Content from './Content';
import Footer from './Footer';
import apiRequest from './apiRequest';

function App() {
  // const [items, setItems] = useState([
  //   {
  //     id: 1,
  //     checked: false,
  //     item: "Milk"
  //   },
  //   {
  //     id: 2,
  //     checked: true,
  //     item: "Eggs"
  //   },
  //   {
  //     id: 3,
  //     checked: false,
  //     item: "Bread"
  //   }
  // ]);
  const [newItem, setNewItem] = useState('')
  const [search, setSearch] = useState('')

  // const [items, setItems] = useState(JSON.parse(localStorage.getItem('shoppinglist')) || []);
  // This way, it will load only when the page load and never again, so changes on the items will not be affected.
  // so it will laod the items and that's it.
  // useEffect(() => {
  //   setItems(JSON.parse(localStorage.getItem('shoppinglist')))
  // }, [])

  // useEffect laod once at the page load so it set the items into the localStorage (at an empty array first)
  // then when we add/remove items, it run on the item and will save it with the changes.
  // useEffect(() => {
  //   localStorage.setItem('shoppinglist', JSON.stringify(items))
  // }, [items])

  // fetch data from API
  const API_URL = 'http://localhost:3500/items'
  const [items, setItems] = useState([]);
  const [fetchError, setFetchError] = useState(null)
  const [isLoading, setIsLoading] = useState(true)

  useEffect(() => {
    const fetchItems = async () => {
      try {
        const response = await fetch(API_URL)
        if (!response.ok) throw Error('Did not receive expected data')
        const listItems = await response.json()
        setItems(listItems)
        setFetchError(null)
      } catch (err) {
        setFetchError(err.message)
      } finally {
        setIsLoading(false)
      }
    }

    setTimeout(() => {
      (async() => await fetchItems())()
    }, 2000)

  }, [])

  console.log('after use effect')

  const handleCheck = async (id) => {
    console.log("check")
    const listItems = items.map((item) => item.id === id ? { ...item, checked: !item.checked } : item)
    setAndSaveItems(listItems)

    const myItem = listItems.filter((item) => item.id === id)
    const updateOptions = {
      method: 'PATCH',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ checked: myItem[0].checked })
    }
    const result = await apiRequest(`${API_URL}/${id}`, updateOptions)
    if (result) setFetchError(result)
  }

  const handleDelete = async (id) => {
    console.log("delete")
    const listItems = items.filter((item) => item.id !== id)
    setAndSaveItems(listItems)

    const deleteOptions = { method: 'DELETE' }
    const result = await apiRequest(`${API_URL}/${id}`, deleteOptions)
    if (result) setFetchError(result)
  }

  const addItem = async (item) => {
    const id = items.length ? items[items.length - 1].id + 1 : 1;
    const myNewItem = { id, checked: false, item };
    const listItems = [...items, myNewItem];
    setAndSaveItems(listItems);

    const postOptions = {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(myNewItem)
    }
    const result = await apiRequest(API_URL, postOptions)
    if (result) setFetchError(result)
  }

  const setAndSaveItems = (newItems) => {
    setItems(newItems)
    // since it get save all the time on the useEffect (with item dependencies), we don't need to set it here again
    // localStorage.setItem('shoppinglist', JSON.stringify(newItems))
  }

  const handleSubmit = (e) => {
    e.preventDefault();
    if (!newItem) return;
    addItem(newItem);
    setNewItem('');
  }

  return (
    <div className="App">
      <Header title="Groceries" />
      <AddItem
        newItem={newItem}
        setNewItem={setNewItem}
        handleSubmit={handleSubmit}
      />
      <SearchItem search={search} setSearch={setSearch} />
      <main>
        {isLoading &&<p>Loading Items...</p>}
        {fetchError && <p style={{ color: "red" }}>{`Error: ${fetchError}`}</p>}
        {!fetchError && !isLoading && <Content
          items={items.filter(item => ((item.item).toLowerCase()).includes(search.toLowerCase()))}
          handleCheck={handleCheck}
          handleDelete={handleDelete}
        />}
      </main>
      <Footer length={items.length} />
    </div>
  );
}

export default App;
