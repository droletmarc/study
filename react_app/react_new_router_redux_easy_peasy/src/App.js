import Header from './Header';
import Nav from './Nav';
import Home from './Home';
import About from './About';
import NewPost from './NewPost';
import EditPost from './EditPost'
import PostPage from './PostPage';
import Missing from './Missing';
import Footer from './Footer';
import { Routes, Route } from 'react-router-dom';
import { useEffect } from 'react'
import useAxiosFetch from './hooks/useAxiosFetch';
import { useStoreActions } from 'easy-peasy'

function App() {
  const setPosts = useStoreActions((actions) => actions.setPosts)
  const { data, fetchError, isLoading } = useAxiosFetch('http://localhost:3500/posts');

    useEffect(() => {
        setPosts(data);
    }, [data, setPosts])

  return (
    <div className="App">
      <Header title="react JS Blog" />
        <Nav />
        <Routes>
          <Route exact path="/" element={<Home
            isLoading={isLoading}
            fetchError={fetchError}
          />} />
          <Route exact path= "/post" element={<NewPost />} />
          <Route path= "/edit/:id" element={<EditPost />} />
          <Route path= "/post/:id" element={<PostPage />} />
          <Route path= "/about" element={<About />} />
          <Route path= "*" element={<Missing />} />
        </Routes>
      <Footer />
    </div>
  )
}

export default App;
