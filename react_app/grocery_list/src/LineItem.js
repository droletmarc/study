import { FaTrashAlt } from 'react-icons/fa'

const LineItem = ({ item, handleCheck, handleDelete }) => {
  return (
    <li className="item">
          <input
            type="checkbox"
            onChange={() => handleCheck(item.id)}
            checked={item.checked}
          />
          <label
            onDoubleClick={() => handleCheck(item.id)}
            style={(item.checked) ? { textDecoration: 'line-through' } : null}
          >{item.item}</label>
          <FaTrashAlt role="button" tabIndex="0" area-lable={`Delete ${item.item}`} onClick={() => handleDelete(item.id)}>Delete</FaTrashAlt>
        </li>
  )
}


export default LineItem
