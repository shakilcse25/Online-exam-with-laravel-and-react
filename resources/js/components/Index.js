import React from 'react';
import ReactDOM from 'react-dom';
import Header from './layout/Header';
import '../Style.scss';

function Index() {
    return (
        <div>
            <div className="header-area">
                <Header />
            </div>
        </div>
    );
}

export default Index;

// DOM element
if (document.getElementById('app')) {
    ReactDOM.render(<Index />, document.getElementById('app'));
}
