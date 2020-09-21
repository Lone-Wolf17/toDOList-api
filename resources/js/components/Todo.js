import React from 'react';
import axios from 'axios';

export default function Todo ({ todo, index, onTodoDeleted }) {

    const deleteTodo = () => {
        axios.delete('http://localhost:8000/api/todos/' + todo.id)
            .then((res) => {
                window.location.reload(false);
                // onTodoDeleted(index);
                console.log('Todo removed, deleted!')
            }).catch((error) => {
                console.log(error)
        })
    }

    const completeTodo = () => {

        // todo.is_completed = !todo.is_completed;

        axios.put(`api/todos/${todo.id}`)
            .then((res) => {
                window.location.reload(false);
                console.log('Todo marked as completed !')
            }).catch((error) => {
            console.log(error)
        })
    }

    return (
      <div>
          <h1 className={todo.is_completed ? 'complete' : ''}>{todo.title}</h1>
          <button onClick={deleteTodo}  >Delete</button>
          <button onClick={completeTodo} >Complete</button>
      </div>
    );
}
