import React from 'react'

// const Header = (props) => { // need to use {props.title} below
const Header = ({ title }) => {
  return (
    <header><h1>{title}</h1></header>
  )
}

//  default props
Header.defaultProps = {
  title: "Default Title"
}

export default Header
