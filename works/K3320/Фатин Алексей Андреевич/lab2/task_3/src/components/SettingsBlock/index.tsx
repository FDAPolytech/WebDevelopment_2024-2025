import { observer } from "mobx-react-lite";
import styles from "./index.module.scss";
import { useStore } from "../../store";
import { Input } from "../Input";

export const SettingsBlock = observer(() => {
  const { showFlow, handleIntervalChange, runFlow, canStart, deletePage } =
    useStore();

  return (
    <div className={styles.root}>
      <h2>Настроить показ: </h2>
      <div className={styles.inputs}>
        {showFlow.map((showFlowPiece) => (
          <div className={styles.piece__block} key={showFlowPiece.id}>
            <h3 className={styles.piece__title}>{showFlowPiece.page.title}</h3>
            <div className={styles.piece__input}>
              <Input
                key={`input_${showFlowPiece.id}`}
                value={showFlowPiece.interval}
                onChange={(e) => handleIntervalChange(showFlowPiece.id, e)}
              />
              <span className={styles.seconds}>секунд</span>
            </div>

            <div
              className={styles.cross}
              onClick={() => deletePage(showFlowPiece.id)}
            />
          </div>
        ))}
      </div>
      {canStart && (
        <button className={styles.button} onClick={runFlow}>
          НАЧАТЬ
        </button>
      )}
    </div>
  );
});
