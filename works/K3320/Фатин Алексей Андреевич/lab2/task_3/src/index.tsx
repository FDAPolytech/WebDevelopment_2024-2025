import React from "react";
import ReactDOM from "react-dom/client";
import "./index.css";
import { App } from "./App";
import { RootStore, RootStoreContext } from "./store";

const root = ReactDOM.createRoot(
  document.getElementById("root") as HTMLElement
);

const store = new RootStore();

root.render(
  <React.StrictMode>
    <RootStoreContext.Provider value={store}>
      <App />
    </RootStoreContext.Provider>
  </React.StrictMode>
);
