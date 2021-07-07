import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class EmpPerformanceAdd extends Component{
    render() {
        return(
            <div className="">
                <form className="form-horizontal" >
                    <div className="form-group">
                        <label className="col-md-2 control-label"> Title </label>
                        <div className="col-md-10">
                            <input type="text" name="title" id="title" className="form-control" placeholder="Title" />
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

if (document.getElementById('emp_performance_add')) {
    ReactDOM.render(<EmpPerformanceAdd />, document.getElementById('emp_performance_add'));
}