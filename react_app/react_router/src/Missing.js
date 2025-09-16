import { Link } from 'react-router-dom'

const Missing = () => {
  return (
    <main className="Missing">
      <h2>Page not found</h2>
      <p>
        <Link to="/">Visit out home page</Link>
      </p>
    </main>
  )
}

export default Missing
