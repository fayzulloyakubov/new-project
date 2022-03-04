import React from 'react'
import {render} from "react-dom";
import Menu from './modules/MenuList';
import {BrowserRouter as Router, Route, Switch} from 'react-router-dom';
const app = (
    <Router>
        <Switch>
            <Route exact compact component={Menu}/>
        </Switch>
    </Router>
);

render(app, window.document.getElementById('root'));