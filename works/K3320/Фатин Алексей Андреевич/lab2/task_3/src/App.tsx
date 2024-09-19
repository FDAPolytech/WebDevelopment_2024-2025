import { observer } from "mobx-react-lite";
import styles from "./App.module.scss";
import { Iframe } from "./components/Iframe";
import { SettingsBlock } from "./components/SettingsBlock";
import { useStore } from "./store";
import meme from "./meme.png";

export const App = observer(() => {
  const store = useStore();

  return (
    <div className={styles.app}>
      <div className={styles.header}>
        <div className={styles.buttons}>
          {store.MOCKED_PAGES.map((page) => (
            <button
              key={page.id}
              className={styles.button}
              onClick={() => store.addPage(page.id)}
            >
              {page.title}
            </button>
          ))}
        </div>
        {!store.isRunningFlow && <SettingsBlock />}
      </div>

      <div className={styles.content}>
        {store.currentlyPlaying && !store.congratIsShown && (
          <Iframe src={store.currentlyPlaying.page.src} />
        )}

        {store.congratIsShown && (
          <img className={styles.image} src={meme} alt="meme" />
        )}
      </div>
    </div>
  );
});
