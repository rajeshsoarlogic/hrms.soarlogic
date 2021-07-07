import { times } from 'lodash';
import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import { data } from 'jquery';

export default class DepartmentAdd extends Component{
    constructor(props){
        super(props);

        this.state = {
            title: ''
        }

        //this.onChangeTitle = this.onChangeTitle.bind(this);
    }

    handleInput = (e) => {
        this.setState({[e.target.name]: e.target.value});
    };

    saveDepartment = async (e) => {
        e.preventDefault();
        const res = await axios.post("api/department/store", this.state);
        if(res.data.status == 200){
            this.props.history.push("/react/department");
        }
    };

    render() {
        return(
            <div className="">
                <form className="form-horizontal" onSubmit={this.saveDepartment}>
                    <div className="form-group">
                        <label className="col-md-2 control-label"> Title </label>
                        <div className="col-md-10">
                            <input type="text" name="title" id="title" className="form-control" placeholder="Title" value={this.state.title} onChange={this.handleInput} />
                        </div>
                    </div>

                    <div className="form-group">
                        <label className="col-md-2 control-label"></label>
                        <div className="col-md-2">
                            <input type="submit" className="btn btn-bordered btn-info btn-block save-designation-btn" id="save-designation-btn" value="Submit" />
                        </div>
                        <div className="col-md-2">
                            <a className="btn btn-bordered btn-success btn-block" href="{{route('designation.index')}}">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        );
    }
}

if (document.getElementById('department_add')) {
    ReactDOM.render(<DepartmentAdd />, document.getElementById('department_add'));
}