import React from 'react'

const SearchItem = ({ search, setSearch }) => {
  return (
    <form className="searchForm" onSubmit={(e) => e.presentDefault() }>
      <label>SearchItem</label>
      <input
        type="text"
        role="searchbox"
        placeholder="Search Item"
        value={search}
        onChange={(e) => setSearch(e.target.value)}
      />
    </form>
  )
}

export default SearchItem
