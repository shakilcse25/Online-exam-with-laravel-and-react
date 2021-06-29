import React from 'react';
import ReactDOM from 'react-dom';
import Header from './layout/Header';
import '../Style.scss';
import HomePage from "./pages/HomePage";
import Footer from "./layout/Footer";
import { BrowserRouter as Router,Switch,Route,Link } from "react-router-dom";
import About from "./pages/About";
import Exam from "./pages/Exam";

function Index() {
    return (
        <Router>
            <div>
                <div className="header-area">
                    <Header />
                    <div className="content-area">
                        <Switch>
                            <Route exact path="/">
                                <HomePage />
                            </Route>
                            <Route path="/about">
                                <About />
                            </Route>
                            <Route path="/exam">
                                <Exam />
                            </Route>
                        </Switch>
                    </div>
                    <Footer />
                </div>
            </div>
        </Router>
    );
}

export default Index;

// DOM element
if (document.getElementById('app')) {
    ReactDOM.render(<Index />, document.getElementById('app'));
}
