import React from 'react'

const TableItem = ({ item }) => {
  return (
    <tr>
      {Object.entries(item).map(([k, val]) => (
        <td key={k}>{JSON.stringify(val)}</td>
      ))}
    </tr>
  )
}

export default TableItem
