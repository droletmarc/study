import React from 'react'
import TableItem from './TableItem'

const Table = ({ items }) => {
  return (
    <div className="table-container">
      <table>
        <tbody>
          {items.map((item) => (
            <TableItem item={item} />
          ))}
        </tbody>
      </table>
    </div>
  )
}

export default Table
