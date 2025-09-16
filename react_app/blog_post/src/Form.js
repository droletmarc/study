import React from 'react'
import Button from './Button'

const Form = ({ menuTypes, reqType, setReqType}) => {
  return (
    <form className="form" onSubmit={(e) => e.preventDefault()}>
      {menuTypes.map((menuType) => (
        <Button
          buttonText={menuType}
          reqType={reqType}
          setReqType={setReqType}
        />
      ))}
    </form>
  )
}

export default Form
