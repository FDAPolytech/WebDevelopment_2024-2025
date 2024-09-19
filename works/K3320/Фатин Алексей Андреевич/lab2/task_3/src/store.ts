import { Context, createContext, useContext } from "react";
import { WIKIPEDIA_PAGES } from "./consts";
import { action, makeObservable, observable } from "mobx";
import _ from "lodash";
import { wait } from "./shared/wait";

type Page = {
  id: number;
  title: string;
  src: string;
};

type ShowConfig = {
  page: Page;
  interval: number;
  id: string;
};

export class RootStore {
  public readonly MOCKED_PAGES: Page[] = WIKIPEDIA_PAGES;
  public showFlow: ShowConfig[] = [];
  public currentlyPlaying: ShowConfig | null = null;
  public congratIsShown = false;
  public isRunningFlow = false;

  constructor() {
    makeObservable<this, "changeShowFlow">(this, {
      showFlow: observable,
      changeShowFlow: action,

      currentlyPlaying: observable,
      runFlow: action,

      isRunningFlow: observable,

      congratIsShown: observable,
    });
  }

  public addPage = (id: number) => {
    const newPage = this.MOCKED_PAGES.find((page) => page.id === id);
    if (!newPage) return;

    this.changeShowFlow([
      ...this.showFlow,
      { page: newPage, id: _.uniqueId(), interval: 0 },
    ]);
  };

  public deletePage = (id: string) => {
    this.changeShowFlow(this.showFlow.filter((elem) => elem.id !== id));
  };

  public handleIntervalChange = (
    id: ShowConfig["id"],
    e: React.FormEvent<HTMLInputElement>
  ) => {
    const flowPieceId = this.showFlow.findIndex((elem) => elem.id === id);
    if (flowPieceId === -1) return;

    const newInterval = Number(e.currentTarget.value);

    this.changeShowFlow([
      ...this.showFlow.slice(0, flowPieceId),
      { ...this.showFlow[flowPieceId], interval: newInterval },
      ...this.showFlow.slice(flowPieceId + 1),
    ]);
  };

  public runFlow = async () => {
    if (this.showFlow.length === 0) return;

    this.isRunningFlow = true;
    this.congratIsShown = false;

    for (const page of this.showFlow) {
      this.currentlyPlaying = page;
      await wait(page.interval * 1000);
    }

    this.congratIsShown = true;
    this.isRunningFlow = false;
  };

  public get canStart() {
    return (
      this.showFlow.length > 0 &&
      this.showFlow.every((elem) => elem.interval > 0)
    );
  }

  private changeShowFlow = (newShowFlow: RootStore["showFlow"]) => {
    this.showFlow = newShowFlow;
  };
}

export const RootStoreContext = createContext<RootStore | null>(null);
export const useStore = () =>
  useContext(RootStoreContext as Context<RootStore>);
