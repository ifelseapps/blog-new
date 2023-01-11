import React, { useMemo, useRef, useState } from 'react';
import JoditEditor, { Jodit } from 'jodit-react';

export function Editor() {
  const editorRef = useRef(null);
  const [content, setContent] = useState('');

  const config = useMemo<Partial<Jodit['options']>>(
    () => ({
      height: '500px',
      buttons: [
        "bold",
        "italic",
        "underline",
        "strikethrough",
        "|",
        "ul",
        "ol",
        "|",
        "paragraph",
        "image",
        "link",
        "hr",
      ],
    }),
    []
  );

  return (
    <JoditEditor
      ref={editorRef}
      value={content}
      config={config}
      onBlur={setContent}
    />
  );
}
