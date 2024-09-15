import styles from "./index.module.scss";

export const Iframe = ({ src }: { src: string }) => {
  return <iframe className={styles.root} src={src} title="web-exlporer" />;
};
