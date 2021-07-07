import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class DepartmentEdit extends Component{
    constructor(props){
        super(props);
    }

    componentDidMount() {
        axios.get('http://localhost:8000/api/expenses/' + this.props.match.params.id).then(res => {
            this.setState({
                name: res.data.name,
                amount: res.data.amount,
                description: res.data.description
            });
        }).catch((error) => {
            console.log(error);
        })
    }

    render() {
        return(
            <div className="">
                <form className="form-horizontal" >
                    <div class="form-group">
                        <label class="col-md-2 control-label"> Title </label>
                        <div class="col-md-10">
                            <input type="text" name="title" id="title" value="" class="form-control" placeholder="Title" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"></label>
                        <div class="col-md-2">
                            <input type="submit" class="btn btn-bordered btn-info btn-block save-performance-btn" id="save-performance-btn" value="Submit" />
                        </div>
                        <div class="col-md-2">
                            <a class="btn btn-bordered btn-success btn-block" href="#">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        );
    }
}

if (document.getElementById('department_edit')) {
    ReactDOM.render(<DepartmentEdit />, document.getElementById('department_edit'));
}