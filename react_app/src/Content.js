import React from 'react'
import { useState } from 'react'
import { FaTrashAlt } from 'react-icons/fa'

const Content = () => {
  const [items, setItems] = useState([
    {
      id: 1,
      checked: false,
      item: "Milk"
    },
    {
      id: 2,
      checked: true,
      item: "Eggs"
    },
    {
      id: 3,
      checked: false,
      item: "Bread"
    }
  ]);

  const handleCheck = (id) => {
    console.log("check")
  }

  return (
    <main>
      <ul>
        {items.map((item) => (
          <li key={item.id} className="item">
            <input
              type="checkbox"
              onChange={() => {}}
              checked={item.checked}
            />
            <label
              style={(item.checked) ? { textDecoration: 'line-through' } : null}
            >{item.item}</label>
            <FaTrashAlt role="button" tabIndex="0" onClick={(e) => {}}>Delete</FaTrashAlt>
          </li>
        ))}
      </ul>
    </main>
  )
}

export default Content
