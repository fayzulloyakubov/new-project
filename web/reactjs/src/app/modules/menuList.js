import React from 'react';
import {render} from "react-dom";
import axios from "axios";
const API_URL = window.location.protocol + "//" + window.location.host + "/api/version/menus/";

class Index extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            isLoading:true,
            items: []
        }
    }

    componentDidMount() {
        this.getData().then(r => {
            console.log("");
        });
    };

    async getData()
    {
        let response = await axios.get(API_URL + 'index');
        if (response.data.status) {
            this.setState({items: response.data.items,isLoading: false})
        }
    };

    render() {
        let { items } = this.state;
        return (
            <ul className={"nav nav-pills nav-sidebar flex-column tree"} data-widget="treeview" role={"menu"} data-accordion="false">
                {
                    items?.length > 0 && items.map((item, key) => {
                        return (
                            <li className={item?.children?.length > 0 ? "nav-item menu-is-opening menu-open" : "nav-item"} key={key}>
                                <a href={item?.children?.length === 0 ? item.url : "#"} className={"nav-link"} aria-expanded={false}>
                                    <i className={item.icon+" nav-icon"}/>
                                    <p>{item.name}</p>
                                </a>
                                <ul className="nav nav-treeview">
                                    {
                                        item?.children?.length > 0 && item.children.map((child, childKey) => {
                                            return (
                                                <li className={"nav-item"} key={childKey}>
                                                    <a href={child.url} className={"nav-link"}>
                                                        <i className={child.icon + " nav-icon"}/>
                                                        <p>{child.name}</p>
                                                    </a>
                                                </li>
                                            )
                                        })
                                    }
                                </ul>
                            </li>
                        )
                    })
                }
            </ul>

        );
    }
}
export default Index;
