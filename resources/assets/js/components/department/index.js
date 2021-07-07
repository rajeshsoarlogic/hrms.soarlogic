import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter as Router, Switch, Route, Link } from "react-router-dom";
import axios from "axios";

axios.defaults.baseURL = "http://localhost/hrms/index.php/";

export default class Department extends Component {
    constructor(props) {
        super(props);
        this.state = {
            departments: []
        }
    }

    componentDidMount(){
        axios.get('api/departments').then(response=>{
            //console.log(response.data);
            this.setState({
                departments: response.data.departments
            });
        });
    }
    deleteDepartment = (id) => {
        //alert(id);
        axios.delete(`api/department/delete/${id}`).then(response => {
            if(response.data.status == 200){
                alert("Department deleted successfully");
            }else{
                alert("Some error occured");
            }
        });
    }
    
    render() {
        return (
            <div className="table-responsive">
                <table className="table allcp-form theme-warning tc-checkbox-1 fs13">
                    <thead>
                        <tr className="bg-light">
                            <th className="text-center">#</th>
                            <th className="text-center">Name</th>
                            <th className="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {Object.entries(this.state.departments).map(([key, value]) => (
                            <tr key={value.id}>
                                <td className="text-center">{++key}</td>
                                <td className="text-center">{value.title}</td>
                                <td className="text-center">
                                    <Router>
                                    <Link to="department/edit/">home</Link>
                                    </Router>
                                    <button type="button" className="btn btn-info br2 btn-xs fs12">
                                        <span className="fa fa-pencil"></span>
                                    </button>
                                    <button type="button" onClick={()=>this.deleteDepartment(value.id)} className="btn btn-danger br2 btn-xs fs12">
                                        <span className="fa fa-trash"></span>
                                    </button>
                                </td>
                            </tr>
                        ))}
                        
                    </tbody>
                </table>
            </div>
        );
    }
}

if (document.getElementById('department')) {
    ReactDOM.render(<Department />, document.getElementById('department'));
}
