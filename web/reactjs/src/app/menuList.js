import React, {Component} from 'react';
import {render} from "react-dom";
import axios from "axios";
const API_URL = window.location.protocol + "//" + window.location.host + "/api/Menus/";

class MenuList extends Component {
    constructor(props) {
        super(props);
        this.state = {
            items: []
        }
    }

    componentDidMount() {
        this.getReportData().then(r => {
            console.log("ok");
        });
    };

    async getReportData()
    {
        let response = await axios.get(API_URL + 'left?type=MENU_LIST');
        if (response.data.status) {
            this.setState({items: response.data.items})
        }
    };

    render() {
        let { items } = this.state;

        let dataBody = "";
        let iterator = 0;
        if (items.length > 0){
            dataBody =  items.map(function (item, index) {
                return (
                    <div>{dataBody}</div>
                );
            });
        }

        return (
                <ul>

                </ul>
        );
    }
}
render((<MenuList/>), window.document.getElementById('root'));
