import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class EmployeePerformance extends Component {
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
                        <tr>
                            <td className="text-center"></td>
                            <td className="text-center"></td>
                            <td className="text-center">
                                <div className="btn-group text-right">
                                    <button type="button" className="btn btn-success br2 btn-xs fs12 dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Action
                                        <span className="caret ml5"></span>
                                    </button>
                                    <ul className="dropdown-menu" role="menu">
                                        <li>
                                            <a href="">Edit</a>
                                        </li>
                                        <li>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        );
    }
}

if (document.getElementById('emp_performance')) {
    ReactDOM.render(<EmployeePerformance />, document.getElementById('emp_performance'));
}
